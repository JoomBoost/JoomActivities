<?php
/**
 * @package      pkg_joomactivities
 * @subpackage   com_joomactivities
 *
 * @author       JoomBoost
 * @copyright    Copyright (C) 2018 JoomBoost.com. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

require_once JPATH_SITE . '/components/com_joomactivities/helpers/route.php';
JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_joomactivities/models', 'JoomActivitiesModel');

$controller = JControllerLegacy::getInstance('Joomactivities');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
