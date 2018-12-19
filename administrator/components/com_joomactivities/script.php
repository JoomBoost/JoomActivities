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


class com_joomactivitiesInstallerScript
{
    protected function _install($parent, $update = false) {
        $manifest		= $parent->get("manifest");
        $parent			= $parent->getParent();
        $source			= $parent->getPath("source");
        $module_attr	= $manifest->modules->attributes();
        $module_path	= isset($module_attr['folder']) ? '/' . $module_attr['folder'] : '';
        $plugin_attr	= $manifest->plugins->attributes();
        $plugin_path	= isset($plugin_attr['folder']) ? '/' . $plugin_attr['folder'] : '';

        $installer	= new JInstaller();

        // Install modules.
        foreach ($manifest->modules->module as $module) {
            $attributes	= $module->attributes();
            $path		= $source . $module_path . '/' . $attributes['name'];
            $installer->install($path);
        }

        // Install plugins.
        $plugins	= array();
        $db			= JFactory::getDbo();

        foreach ($manifest->plugins->plugin as $plugin) {
            $attributes	= $plugin->attributes();
            $path		= $source . $plugin_path . '/' . $attributes['group'] . '/' . $attributes['name'];

            if ($attributes['enable']) {
                $plugins[]	= $db->quote($attributes['name']);
            }

            $installer->install($path);
        }

        // Public plugins.
        if (!$update && count($plugins)) {
            $query	= 'UPDATE #__extensions'
                . ' SET enabled = 1'
                . ' WHERE element IN (' . implode(', ', $plugins) . ') AND type = \'plugin\' AND enabled = 0'
            ;
            $db->setQuery($query);
            $db->query();
        }
    }

    /**
     * Install.
     *
     * @param	$parent
     */
    public function install($parent) {
        $this->_install($parent);
    }

    /**
     * Update.
     *
     * @param	$parent
     */
    public function update($parent) {
        $this->_install($parent, true);
    }
}
