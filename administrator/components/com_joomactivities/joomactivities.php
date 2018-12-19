<?php
/**
 * @package      pkg_joomactivities
 * @subpackage   com_joomactivities
 *
 * @author       JoomBoost
 * @copyright    Copyright (C) 2012-2018 JoomBoost. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();


// Access check
if (!JFactory::getUser()->authorise('core.manage', 'com_joomactivities')) {
	return JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependencies
jimport('joomla.application.component.controller');
jimport('joomla.application.component.helper');


// Register classes to autoload
JLoader::register('JoomActivitiesHelper', JPATH_ADMINISTRATOR . '/components/com_joomactivities/helpers/joomactivities.php');

$controller = JControllerLegacy::getInstance('JoomActivities');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
