<?php
/**
 * @package      pkg_joomactivities
 * @subpackage   plg_content_joomactivities
 *
 * @author       JoomBoost
 * @copyright    Copyright (C) 2018 JoomBoost. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();


// Register the component model and table
JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_joomactivities/models', 'JoomActivitiesModel');

// Register component table classes
JLoader::register('JoomActivitiesTableItem', JPATH_ADMINISTRATOR . '/components/com_joomactivities/tables/item.php');
JLoader::register('JTableJoomActivities',    JPATH_ADMINISTRATOR . '/components/com_joomactivities/tables/joomactivities.php');
// JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_joomactivities/tables');

// Register the activity plugin class
JLoader::register('plgJoomActivities', dirname(__FILE__) . '/plugin.php');

// Include the user activity plugins
JPluginHelper::importPlugin('joomactivities');


/**
 * User Activity Content Plugin.
 *
 */
class plgContentJoomActivities extends JPlugin
{
    /**
     * Event dispatcher instance
     *
     * @var    object
     */
    protected $dispatcher;

    /**
     * List of unsupported contexts
     *
     * @var    array
     */
    protected $unsupported;


    /**
     * Constructor
     *
     * @param    object    $subject    The object to observe
     * @param    array     $config     An optional associative array of configuration settings.
     */
    public function __construct(&$subject, $config = array())
    {
        // Call parent contructor first
        parent::__construct($subject, $config);

        // Get the dispatcher
        $this->dispatcher = version_compare(JVERSION,'4','lt') ? JDispatcher::getInstance() : \Joomla\CMS\Factory::getApplication();

        // Set unsupported contexts
        $this->unsupported = array(
            'com_joomactivities.item',
            'com_joomactivities.event',
            'com_joomactivities.activity'
        );
    }


    /**
     * Triggers User Activity Plugins for the "onContentAfterSave" event
     *
     * @param     string     $context    The item context
     * @param     object     $table      The item table object
     * @param     boolean    $is_new     New item indicator (True is new, False is update)
     *
     * @return    boolean                True
     */
    public function onContentAfterSave($context, $table, $is_new)
    {
        if (!in_array($context, $this->unsupported)) {
            if (JDEBUG) {
                JProfiler::getInstance()->mark('beforeJoomActivities' . $context);
            }

            if (JFactory::getUser()->authorise('core.create', 'com_joomactivities')) {
                $this->dispatcher->trigger('onJoomActivitiesAfterSave', array($context, $table, $is_new));
            }

            if (JDEBUG) {
                JFactory::getApplication()->enqueueMessage(JProfiler::getInstance()->mark('afterJoomActivities' . $context), 'notice');
            }
        }

        return true;
    }


    /**
     * Triggers User Activity Plugins for the "onContentAfterDelete" event
     *
     * @param     string     $context    The item context
     * @param     object     $table      The item table object
     *
     * @return    boolean                True
     */
    public function onContentAfterDelete($context, $table)
    {
        if (!in_array($context, $this->unsupported)) {
            if (JDEBUG) {
                JProfiler::getInstance()->mark('beforeJoomActivities' . $context);
            }

            if (JFactory::getUser()->authorise('core.create', 'com_joomactivities')) {
                $this->dispatcher->trigger('onJoomActivitiesAfterDelete', array($context, $table));
            }

            if (JDEBUG) {
                JFactory::getApplication()->enqueueMessage(JProfiler::getInstance()->mark('afterJoomActivities' . $context), 'notice');
            }
        }

        return true;
    }


    /**
     * Triggers User Activity Plugins for the "onContentChangeState" event
     *
     * @param     string     $context    The item context
     * @param     array      $pks        The item id's whose state was changed
     * @param     integer    $value      New state to which the items were changed
     *
     * @return    boolean                True
     */
    public function onContentChangeState($context, $pks, $value)
    {
        if (!in_array($context, $this->unsupported)) {
            if (JDEBUG) {
                JProfiler::getInstance()->mark('beforeJoomActivities' . $context);
            }

            if (JFactory::getUser()->authorise('core.create', 'com_joomactivities')) {
                $this->dispatcher->trigger('onJoomActivitiesChangeState', array($context, $pks, $value));
            }

            if (JDEBUG) {
                JFactory::getApplication()->enqueueMessage(JProfiler::getInstance()->mark('afterJoomActivities' . $context), 'notice');
            }
        }

        return true;
    }
}
