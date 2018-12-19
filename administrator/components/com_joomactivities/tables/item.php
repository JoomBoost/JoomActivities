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


/**
 * User Activity Item Table Class
 *
 */
class JoomActivitiesTableItem extends JTable
{
    /**
     * Constructor
     *
     * @param    object    $db    A database connector object
     */
    public function __construct($db)
    {
        parent::__construct('#__user_activity_items', 'asset_id', $db);

        // Disable asset tracking
        $this->_trackAssets = false;
    }
}
