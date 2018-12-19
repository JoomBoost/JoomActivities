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
    protected $items;

    protected $pagination;

    protected $state;

    protected $authors;

    protected $extensions;

    protected $ext_items;

    protected $events;

    protected $locations;

    protected $is_j25;

    protected $user;

    protected $params;


    /**
     * Displays the view.
     *
     */
    public function display($tpl = null)
    {
        // Get data from model
        $this->items      = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state      = $this->get('State');
        $this->authors    = $this->get('Authors');
        $this->extensions = $this->get('Extensions');
        $this->ext_items  = $this->get('ExtensionItems');
        $this->events     = $this->get('Events');
        $this->locations  = $this->get('Locations');
        $this->params     = JComponentHelper::getParams('com_joomactivities', true);

        // Check for errors
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        $this->is_j25 = version_compare(JVERSION, '3', 'lt');
        $this->user   = JFactory::getUser();

        // Add the tool- and sidebar
        if ($this->getLayout() !== 'modal') {
            $this->addToolbar();

            // Add the sidebar (Joomla 3 and up)
            if (!$this->is_j25) {
                $this->addSidebar();
                $this->sidebar = JHtmlSidebar::render();
            }
        }

        parent::display($tpl);
    }


    /**
     * Adds the page title and toolbar.
     *
     * @return    void
     */
    protected function addToolbar()
    {
        $user = JFactory::getUser();

        JToolBarHelper::title(JText::_('COM_JOOMACTIVITIES_ACTIVITIES_TITLE'), 'article.png');

        if ($user->authorise('core.edit.state', 'com_joomactivities')) {
            JToolBarHelper::divider();
            JToolBarHelper::publish('activities.publish', 'JTOOLBAR_PUBLISH', true);
            JToolBarHelper::unpublish('activities.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            JToolBarHelper::divider();
            JToolBarHelper::archiveList('activities.archive');
        }

        if ($this->state->get('filter.published') == -2 && $user->authorise('core.delete', 'com_joomactivities')) {
            JToolBarHelper::deleteList('', 'activities.delete','JTOOLBAR_EMPTY_TRASH');
            JToolBarHelper::divider();
        }
        elseif ($user->authorise('core.edit.state', 'com_joomactivities')) {
            JToolBarHelper::trash('activities.trash');
            JToolBarHelper::divider();
        }

        if ($user->authorise('core.admin', 'com_joomactivities')) {
            JToolBarHelper::preferences('com_joomactivities');
        }
    }


    /**
     * Adds the page side bar for Joomla 3.0 and higher
     *
     * @return    void
     */
    protected function addSidebar()
    {
        JHtmlSidebar::setAction('index.php?option=com_joomactivities&view=activities');

        JHtmlSidebar::addFilter(
            '',
            'filter_client_id',
            JHtml::_('select.options', $this->locations, 'value', 'text', $this->state->get('filter.client_id')),
            false
        );

        JHtmlSidebar::addFilter(
            '',
            'filter_published',
            JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true),
            false
        );

        JHtmlSidebar::addFilter(
            JText::_('JOPTION_SELECT_EVENT'),
            'filter_event_id',
            JHtml::_('select.options', $this->events, 'value', 'text', $this->state->get('filter.event_id'))
        );

        JHtmlSidebar::addFilter(
            JText::_('JOPTION_SELECT_EXTENSION'),
            'filter_extension',
            JHtml::_('select.options', $this->extensions, 'value', 'text', $this->state->get('filter.extension'))
        );

        JHtmlSidebar::addFilter(
            JText::_('JOPTION_SELECT_ACCESS'),
            'filter_access',
            JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'))
        );
    }


    /**
     * Returns an array of fields the table can be sorted by.
     *
     * @return    array    Array containing the field name to sort by as the key and display text as value
     */
    protected function getSortFields()
    {
        return array('a.created' => JText::_('JDATE'));
    }
}
