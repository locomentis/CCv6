<?php
/**
 * CubeCart v6
 * ========================================
 * CubeCart is a registered trade mark of CubeCart Limited
 * Copyright CubeCart Limited 2017. All rights reserved.
 * UK Private Limited Company No. 5323904
 * ========================================
 * Web:   http://www.cubecart.com
 * Email:  sales@cubecart.com
 * License:  GPL-3.0 https://www.gnu.org/licenses/quick-guide-gplv3.html
 */
if (!defined('CC_INI_SET')) {
    die('Access Denied');
}
Admin::getInstance()->permissions('settings', CC_PERM_READ, true);

$GLOBALS['gui']->addBreadcrumb($lang['settings']['bread_tax']);

$GLOBALS['main']->addTabControl($lang['settings']['title_tax_class'], 'taxclasses', null, 'C');
$GLOBALS['main']->addTabControl($lang['settings']['title_tax_detail'], 'taxdetails', null, 'D');
$GLOBALS['main']->addTabControl($lang['settings']['title_tax_rule'], 'taxrules', null, 'R');

$updated  = false;
$redirect  = false;
$anchor  = false;

if (isset($_GET['assign_class']) && $_GET['assign_class']>0) {
    if ($GLOBALS['db']->update('CubeCart_inventory', array('tax_type' => (int)$_GET['assign_class']))) {
        $no_assigned = $GLOBALS['db']->affected();
        $GLOBALS['main']->successMessage(sprintf($lang['settings']['notify_tax_class_assigned'], $no_assigned));
    } else {
        $GLOBALS['main']->errorMessage($lang['settings']['notify_tax_class_not_assigned']);
    }
    $redirect = true;
}

#######################
## Update Tax Classes
if (isset($_POST['class']) && is_array($_POST['class']) && Admin::getInstance()->permissions('settings', CC_PERM_EDIT)) {
    foreach ($_POST['class'] as $key => $data) {
        if ($GLOBALS['db']->update('CubeCart_tax_class', $data, array('id' => $key), true)) {
            $updated = true;
        }
    }
    $redirect = true;
}
## Add Tax Class
if (isset($_POST['addclass']) && is_array($_POST['addclass']) && !empty($_POST['addclass']['tax_name']) && Admin::getInstance()->permissions('settings', CC_PERM_EDIT)) {
    if ($GLOBALS['db']->insert('CubeCart_tax_class', $_POST['addclass'])) {
        $GLOBALS['main']->successMessage($lang['settings']['notify_tax_class_add']);
    } else {
        $GLOBALS['main']->errorMessage($lang['settings']['error_tax_class_add']);
    }
    $redirect = true;
}
## Delete Tax Class
if (isset($_GET['delete_class']) && !empty($_GET['delete_class']) && Admin::getInstance()->permissions('settings', CC_PERM_DELETE)) {
    ## Remove dependancies
    $GLOBALS['db']->delete('CubeCart_tax_rates', array('type_id' => $_GET['delete_class']));
    if ($GLOBALS['db']->delete('CubeCart_tax_class', array('id' => (int)$_GET['delete_class']))) {
        $GLOBALS['main']->successMessage($lang['settings']['notify_tax_class_delete']);
    } else {
        $GLOBALS['main']->errorMessage($lang['settings']['error_tax_class_delete']);
    }
    $redirect = true;
    $anchor = 'taxclasses';
}

#######################
## Update Tax Details
if (isset($_POST['detail']) && is_array($_POST['detail']) && Admin::getInstance()->permissions('settings', CC_PERM_EDIT)) {
    foreach ($_POST['detail'] as $key => $data) {
        if ($GLOBALS['db']->update('CubeCart_tax_details', $data, array('id' => $key), true)) {
            $updated = true;
        }
    }
    $redirect = true;
}
## Add Tax Detail
if (isset($_POST['adddetail']) && is_array($_POST['adddetail']) && !empty($_POST['adddetail']['name']) && !empty($_POST['adddetail']['display']) && Admin::getInstance()->permissions('settings', CC_PERM_EDIT)) {
    if ($GLOBALS['db']->insert('CubeCart_tax_details', $_POST['adddetail'])) {
        $GLOBALS['main']->successMessage($lang['settings']['notify_tax_detail_add']);
    } else {
        $GLOBALS['main']->errorMessage($lang['settings']['error_tax_detail_add']);
    }
    $redirect = true;
}
## Delete Tax Detail
if (isset($_GET['delete_detail']) && !empty($_GET['delete_detail']) && Admin::getInstance()->permissions('settings', CC_PERM_DELETE)) {
    ## Delete dependancies
    $GLOBALS['db']->delete('CubeCart_tax_rates', array('details_id' => $_GET['delete_detail']));
    if ($GLOBALS['db']->delete('CubeCart_tax_details', array('id' => (int)$_GET['delete_detail']))) {
        $GLOBALS['main']->successMessage($lang['settings']['notify_tax_detail_delete']);
    } else {
        $GLOBALS['main']->errorMessage($lang['settings']['error_tax_detail_delete']);
    }
    $redirect = true;
    $anchor = 'taxdetails';
}

#######################
## Update Tax Rules
if (isset($_POST['rule']) && is_array($_POST['rule']) && Admin::getInstance()->permissions('settings', CC_PERM_EDIT)) {
    foreach ($_POST['rule'] as $key => $data) {
        if ($GLOBALS['db']->update('CubeCart_tax_rates', $data, array('id' => $key), true)) {
            $updated = true;
        }
    }
    $redirect = true;
}
## Add Tax Rule
if (isset($_POST['addrule']) && is_array($_POST['addrule']) && is_numeric($_POST['addrule']['tax_percent']) && Admin::getInstance()->permissions('settings', CC_PERM_EDIT)) {
    if ($_POST['addrule']['eu']==1) {
        $eu_countries = $GLOBALS['db']->select('CubeCart_geo_country', 'numcode', array('eu' => 1));
        foreach ($eu_countries as $country) {
            $_POST['addrule']['country_id'] = $country['numcode'];
            $_POST['addrule']['county_id'] = 0;
            $GLOBALS['db']->insert('CubeCart_tax_rates', $_POST['addrule']);
            $GLOBALS['main']->successMessage($lang['settings']['notify_tax_rule_add']);
        }
    } else {
        if($_POST['addrule']['rest']==1) {
            $_POST['addrule']['country_id'] = '999';
        }
        if ($GLOBALS['db']->insert('CubeCart_tax_rates', $_POST['addrule'])) {
            $GLOBALS['main']->successMessage($lang['settings']['notify_tax_rule_add']);
        } else {
            $GLOBALS['main']->errorMessage($lang['settings']['error_tax_rule_add']);
        }
    }
    $redirect = true;
}
## Delete Tax Rule
if (isset($_GET['delete_rule']) && !empty($_GET['delete_rule']) && Admin::getInstance()->permissions('settings', CC_PERM_DELETE)) {
    if ($GLOBALS['db']->delete('CubeCart_tax_rates', array('id' => (int)$_GET['delete_rule']))) {
        $GLOBALS['main']->successMessage($lang['settings']['notify_tax_rule_delete']);
    } else {
        $GLOBALS['main']->errorMessage($lang['settings']['error_tax_rule_delete']);
    }
    $redirect = true;
    $anchor = 'taxrules';
}
if ($updated) {
    ## Generic message as a few things can be updated at once
    $GLOBALS['main']->successMessage($lang['settings']['notify_tax_updated']);
}
if ($redirect) {
    httpredir(currentPage(array('delete_class', 'delete_detail', 'delete_rule', 'assign_class')), $anchor);
}

###############################################################
## Get countries
if (($countries = $GLOBALS['db']->select('CubeCart_geo_country', array('numcode', 'name'), '`status` > 0', array('name' => 'ASC'))) !== false) {
    $GLOBALS['smarty']->assign('COUNTRIES', $countries);
    ## Get counties
    $GLOBALS['smarty']->assign('VAL_JSON_COUNTY', state_json());
    $GLOBALS['smarty']->assign('CONFIG', $GLOBALS['config']->get('config'));
}

## Get Tax Classes
if (($tax_classes = $GLOBALS['db']->select('CubeCart_tax_class')) !== false) {
    $GLOBALS['smarty']->assign('TAX_CLASSES', $tax_classes);
    foreach ($tax_classes as $class) {
        $tax_class[$class['id']] = $class['tax_name'];
    }
}

## Get Tax Details
if (($tax_details = $GLOBALS['db']->select('CubeCart_tax_details')) !== false) {
    foreach ($tax_details as $tax_detail) {
        if ($tax_detail['status']) {
            $tax_detail['enabled'] = 'selected="selected"';
        } else {
            $tax_detail['disabled'] = 'selected="selected"';
        }
        $tax_detail_name = ($tax_detail['name'] == $tax_detail['display']) ? $tax_detail['display'] : $tax_detail['display'].' ('.$tax_detail['name'].')';
        $tax_detail_array[$tax_detail['id']] = $tax_detail_name;
        $smarty_data['tax_details'][] = $tax_detail;
    }
    $GLOBALS['smarty']->assign('TAX_DETAILS', $smarty_data['tax_details']);
}

## Get Tax Rules
if (($tax_rules = $GLOBALS['db']->select('CubeCart_tax_rates')) !== false) {
    foreach ($tax_rules as $rule) {
        $rule['country'] = getCountryFormat($rule['country_id']);
        $rule['state']  = ($rule['county_id'] != 0) ? getStateFormat($rule['county_id']) : $lang['common']['regions_all'];
        $rule['class']  = $tax_class[$rule['type_id']];
        $rule['detail']  = $tax_detail_array[$rule['details_id']];
        $smarty_data['tax_rules'][] = $rule;
    }
    $GLOBALS['smarty']->assign('TAX_RULES', $smarty_data['tax_rules']);
}
foreach ($GLOBALS['hooks']->load('admin.settings.tax.pre_smarty') as $hook) {
	include $hook;
}
$page_content = $GLOBALS['smarty']->fetch('templates/settings.tax.php');
