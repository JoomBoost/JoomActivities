<?php
/**
 * @package      pkg_joomactivities
 * @subpackage   com_joomactivities
 *
 * @author       JoomBoost
 * @copyright    Copyright (C) 2013 JoomBoost.com. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

if (!$this->is_j25) {
    require_once dirname(__FILE__) . '/default_j30.php';
}
else {
    require_once dirname(__FILE__) . '/default_j25.php';
}