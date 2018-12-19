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


if (version_compare(JVERSION, 3, 'ge')) {
    require_once dirname(__FILE__) . '/default_json_j30.php';
}
else {
    require_once dirname(__FILE__) . '/default_json_j25.php';
}
