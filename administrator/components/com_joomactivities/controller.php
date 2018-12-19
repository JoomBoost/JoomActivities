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


class JoomActivitiesController extends JControllerLegacy
{
    /**
     * The default view
     *
     * @var    string
     */
    protected $default_view = 'activities';


    public function display($cachable = false, $urlparams = false)
    {
        parent::display();

        return $this;
    }
}
