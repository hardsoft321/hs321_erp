<?php
/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author  Leon Nikitin <nlv@lab321.ru>
 * @package hs321_erp
 */

$manifest = array(
    'name' => 'hs321_erp',
    'acceptable_sugar_versions' => array(),
    'acceptable_sugar_flavors' => array('CE'),
    'author' => 'Leon.V.Nikitin (nlv@lab321.com)',
    'description' => 'Добавление ERP функционала в SuiteCRM',
    'is_uninstallable' => true,
    'published_date' => '2023-04-13',
    'type' => 'module',
    'version' => '0.7.0.cissystem',
    'dependencies' => array(
      )
);
$installdefs = array(
    'id' => 'hs321_erp',
    'copy' => array (
        array (
            'from' => '<basepath>/source/copy',
            'to' => '.',
        ),
    ),
    'vardefs'=>array(
        array (
            'from' => '<basepath>/source/vardefs/AOS_Products_Quotes/erp_vardefs.php',
            'to_module' => 'AOS_Products_Quotes',
	    ),
        array (
            'from' => '<basepath>/source/vardefs/AOS_Products/erp_vardefs.php',
            'to_module' => 'AOS_Products',
	    ),
    ),
    'logic_hooks' => array(
        array(
          'module' => 'AOS_Products_Quotes',
          'hook' => 'before_save',
          'order' => 100,
          'description'  => 'Recalculating fact and plan remains for Quotes Positions',
          'file' => 'modules/AOS_ERP/RecalculateRemainsHook.php',
          'class' => 'RecalculateRemainsHook',
          'function' => 'before_save',
        ),
    ),
    'action_file_map' => array(
        array(
            'from' => '<basepath>/source/action_file_map/RecalculatePlanRemains.php',
            'to_module' => 'AOS_ERP',
        ),
    ),
    'language'=> array (
        array(
            'from'=> '<basepath>/source/language/application/ru_ru.lang.php',
            'to_module'=> 'application',
            'language'=>'ru_ru'
        ),
        array(
            'from'=> '<basepath>/source/language/application/en_us.lang.php',
            'to_module'=> 'application',
            'language'=>'en_us'
        ),
        array(
            'from'=> '<basepath>/source/language/modules/AOS_ERP/ru_ru.lang.php',
            'to_module'=> 'AOS_ERP',
            'language'=>'ru_ru'
        ),
        array(
            'from'=> '<basepath>/source/language/modules/AOS_ERP/en_us.lang.php',
            'to_module'=> 'AOS_ERP',
            'language'=>'en_us'
        ),
        array(
            'from'=> '<basepath>/source/language/modules/AOS_Products_Quotes/ru_ru.lang.php',
            'to_module'=> 'AOS_Products_Quotes',
            'language'=>'ru_ru'
        ),
        array(
            'from'=> '<basepath>/source/language/modules/AOS_Products_Quotes/en_us.lang.php',
            'to_module'=> 'AOS_Products_Quotes',
            'language'=>'en_us'
        ),
        array(
            'from'=> '<basepath>/source/language/modules/AOS_Products/ru_ru.lang.php',
            'to_module'=> 'AOS_Products',
            'language'=>'ru_ru'
        ),
        array(
            'from'=> '<basepath>/source/language/modules/AOS_Products/en_us.lang.php',
            'to_module'=> 'AOS_Products',
            'language'=>'en_us'
        ),
    ),
);
