<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Leon Nikitin <nlv@lab321.ru>
 * @package hs321_erp
 */

$dictionary["AOS_Products_Quotes"]["fields"]["accdate"] = array (
    'name' => 'accdate',
    'vname' => 'LBL_ACCDATE',
    'type' => 'datetime',
    'required' => false,
    'audited' => true,
);

$dictionary["AOS_Products_Quotes"]["fields"]["wip_status"] = array (
    'name' => 'wip_status',
    'vname' => 'LBL_WIP_STATUS',
    'type' => 'enum',
    'required' => true,
    'default' => 'draft',
    'options' => 'product_quotes_wip_statuses',
    'audited' => true,
);

$dictionary["AOS_Products_Quotes"]["fields"]["type_inout"] = array (
    'name' => 'type_inout',
    'vname' => 'LBL_TYPE_INOUT',
    'type' => 'enum',
    'required' => true,
    'default' => 'out',
    'options' => 'product_quotes_types_inout',
    'audited' => true,
);

$dictionary["AOS_Products_Quotes"]["fields"]["qty_plan"] = array (
    'name' => 'qty_plan',
    'vname' => 'LBL_QTY_PLAN',
    'type' => 'decimal',
    'massupdate' => 0,
    'importable' => 'false',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => true,
    'reportable' => true,
    'len' => '18',
    'size' => '20',
    'enable_range_search' => false,
    'precision' => '4',
    'required' => false,
    'editable' => false,
    'inline_edit' => false,
);
