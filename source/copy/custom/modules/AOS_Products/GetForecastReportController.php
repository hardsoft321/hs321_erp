<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Leon Nikitin <nlv@lab321.ru>
 * @package hs321_erp
 */

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

// require_once('include/formbase.php');

// if ((BeanFactory::newBean('AOS_Products'))->ACLAccess('list') 
if (!isset($_REQUEST['product_id'])) {
  die('Не передан product_id');
}

require_once("custom/modules/AOS_Products_Quotes/RecalculateRemainsHook.php");


$filename = "forecast_report_{$_REQUEST['product_id']}.xlsx";

$writer = WriterFactory::create(Type::XLSX);

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '";');

$filePath = "php://output";

$res = RecalculateRemainsHook::getForecast($_REQUEST['product_id']);

$cells = [
  'Ид продукта',
  'Название продукта',
  'Дата',
  // 'Прирост в день',
  'Кол-во',
];
$rows = [$cells];
foreach ($res as $r) {
  $cells = [
    $r['product_id'],
    $r['product_name'],
    $r['accdate'],
    // $r['product_qty'],
    $r['running_product_qty'],
  ];
  $rows[] = $cells;
}

$writer->openToFile($filePath);

$writer->addRows($rows); 
$writer->close();