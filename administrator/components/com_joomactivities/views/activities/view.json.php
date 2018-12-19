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


jimport('joomla.application.component.view');


class JoomActivitiesViewActivities extends JViewLegacy
{
    /**
     * Displays the view.
     *
     */
    public function display($tpl = null)
    {
        // Get data from model
        $items = $this->get('Items');

        // Check for errors
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            jexit(500);
        }

        echo json_encode($items);
        jexit(201);
    }
}
