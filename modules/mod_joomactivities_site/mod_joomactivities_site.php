<?php
/**
 * @package      pkg_joomactivities
 * @subpackage   mod_joomactivities_site
 *
 * @author       JoomBoost
 * @copyright    Copyright (C) 2013 JoomBoost.com. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();


// Include the helper class.
jimport('joomla.application.module.helper');
require_once JPATH_SITE . '/modules/mod_joomactivities_site/helper.php';

// Prepare model config
$config = array('ignore_request' => true);

if (is_numeric($params->get('group_activity'))) {
    $config['group_activity'] = (int) $params->get('group_activity');
}

// Get module data.
$model = modJoomActivitiesSiteHelper::getModel($config);
$data  = modJoomActivitiesSiteHelper::getItems($params);

// Render the module
require JModuleHelper::getLayoutPath('mod_joomactivities_site', $params->get('layout', 'default'));
