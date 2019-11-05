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
JHtml::_('jquery.framework');
require_once JPATH_SITE . '/components/com_joomactivities/helpers/route.php';
JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_joomactivities/models', 'JoomActivitiesModel');
$globalParams = JComponentHelper::getComponent('com_joomactivities');
if($globalParams->get('bs',1)){
    JHtml::_('stylesheet', 'com_joomactivities/bootstrap/bootstrap.css', false, true);
    JHtml::_('stylesheet', 'com_joomactivities/bootstrap/bootstrapfix.css', false, true);
    JHtml::_('script', 'com_joomactivities/bootstrap/popper.min.js', false, true);
    JHtml::_('script', 'com_joomactivities/bootstrap/bootstrap.js', false, true);
    JHtml::_('script', 'com_joomactivities/bootstrap/bootstrapfix.js', false, true);
}
JHtml::_('stylesheet', 'com_joomactivities/font/all.min.css', false, true);
JHtml::_('stylesheet', 'com_joomactivities/site.css', false, true);

$controller = JControllerLegacy::getInstance('Joomactivities');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
