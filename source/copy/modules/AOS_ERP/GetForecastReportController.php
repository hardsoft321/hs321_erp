<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Leon Nikitin <nlv@lab321.ru>
 * @package hs321_erp
 */

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

// if ((BeanFactory::newBean('AOS_Products'))->ACLAccess('list') 
if (!isset($_REQUEST['product_id'])) {
  die('Не передан product_id');
}

require_once("modules/AOS_ERP/RecalculateRemainsHook.php");
global $app_list_strings, $current_language, $sugar_config;

if(!isset($sugar_config['erp']['module'])) die('ERP Module not set');

$doc_module = $sugar_config['erp']['module'];

$filename = "forecast_report_{$_REQUEST['product_id']}.xlsx";

$writer = WriterFactory::create(Type::XLSX);

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '";');

$filePath = "php://output";

$res = RecalculateRemainsHook::getForecast($_REQUEST['product_id']);

$mod_strings = return_module_language($current_language, 'AOS_ERP');

$labels['ACCDATE'] = 'Accdate';
$labels['TYPE_INOUT'] = 'IN/OUT';
$labels['PRODUCT_QTY'] = 'Product quantity';
$labels['RUNNING_PRODUCT_QTY'] = 'Forecasst quantity';
$labels['POS_ID'] = 'Pos ID';
$labels['DOC_ID'] = 'Quote ID';
$labels['DOC_NAME'] = 'Quote Name';

foreach (['ACCDATE', 'TYPE_INOUT', 'PRODUCT_QTY', 'RUNNING_PRODUCT_QTY', 'POS_ID', 'DOC_ID', 'DOC_NAME'] as $l) {
  if(!isset($mod_strings['LBL_FORECASTREPORT'][$l])) $mod_strings['LBL_FORECASTREPORT'][$l] = 'DEF ' . $labels[$l];
}

$cells = [
  $mod_strings['LBL_FORECASTREPORT']['ACCDATE'],
  $mod_strings['LBL_FORECASTREPORT']['TYPE_INOUT'],
  $mod_strings['LBL_FORECASTREPORT']['PRODUCT_QTY'],
  $mod_strings['LBL_FORECASTREPORT']['RUNNING_PRODUCT_QTY'],
  $mod_strings['LBL_FORECASTREPORT']['POS_ID'],
  $mod_strings['LBL_FORECASTREPORT']['DOC_ID'],
  $mod_strings['LBL_FORECASTREPORT']['DOC_NAME'],
];
$rows = [$cells];
foreach ($res as $r) {
  $type_inout = isset($app_list_strings['product_quotes_types_inout'][$r['type_inout']]) ?
    $app_list_strings['product_quotes_types_inout'][$r['type_inout']] :
    $r['type_inout'];
  $cells = [
    $r['accdate'],
    $type_inout,
    $r['product_qty'],
    $r['running_product_qty'],
    $r['pos_id'],
    $r['doc_id'],
    $r['doc_name'],
  ];
  $rows[] = $cells;
}

$writer->openToFile($filePath);

$writer->addRows($rows); 
$writer->close();