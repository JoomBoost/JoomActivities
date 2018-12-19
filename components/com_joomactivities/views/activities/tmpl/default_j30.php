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


JHtml::_('behavior.tooltip');

$list_order  = $this->escape($this->state->get('list.ordering'));
$list_dir    = $this->escape($this->state->get('list.direction'));
$date_format = $this->params->get('date_format', JText::_('DATE_FORMAT_LC1'));
$date_rel    = (int) $this->params->get('date_relative', 1);
?>
<form action="<?php echo JRoute::_(JoomActivitiesHelperRoute::getActivitiesRoute()); ?>" method="post" name="adminForm" id="adminForm" autocomplete="off">

    <!-- Start Filters -->
    <div class="btn-toolbar">
        <?php if ($this->params->get('show_filter_search')) : ?>
            <div class="btn-group pull-left">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-search"></i></span>
                    <input type="text" class="input-medium" placeholder="<?php echo JText::_('COM_JOOMACTIVITIES_FILTER_SEARCH_DESC'); ?>"
                        name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
                        title="<?php echo JText::_('COM_JOOMACTIVITIES_FILTER_SEARCH_DESC'); ?>"
                    />
                </div>
            </div>
            <div class="btn-group pull-left">
                <button class="btn tip hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
                <button class="btn tip hasTooltip" type="button" onclick="document.id('filter_search').value='';this.form.submit();" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"><i class="icon-remove"></i></button>
            </div>
        <?php endif; ?>
        <?php if ($this->params->get('show_filter_extension')) : ?>
            <div class="btn-group pull-right">
                <select name="filter_extension" onchange="this.form.submit();" class="input-medium">
                    <option value=""><?php echo JText::_('JOPTION_SELECT_EXTENSION'); ?></option>
                    <?php echo JHtml::_('select.options', $this->extensions, 'value', 'text', $this->state->get('filter.extension')); ?>
                </select>
            </div>
        <?php endif; ?>
        <?php if ($this->params->get('show_filter_event')) : ?>
            <div class="btn-group pull-right">
                <select name="filter_event_id" onchange="this.form.submit();" class="input-medium">
                    <option value=""><?php echo JText::_('JOPTION_SELECT_EVENT'); ?></option>
                    <?php echo JHtml::_('select.options', $this->events, 'value', 'text', $this->state->get('filter.event_id')); ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
    </div>
    <!-- End Filters -->

    <!-- Start Items -->
    <div class="row-striped">
        <?php
        foreach ($this->items as $i => $item) :
            $date = JHtml::_('date', $item->created, $date_format);
            ?>
            <div class="row-fluid">
                <div class="span9">
                    <span class="row-title"><?php echo $item->text; ?></span>
                </div>
                <div class="span3">
                    <?php
                        if ($date_rel) :
                            ?>
                            <span class="label hasTip" title="<?php echo $date; ?>" style="cursor: help;">
                                <i class="icon-clock"></i>
                                <?php echo JoomActivitiesHelper::relativeDateTime($item->created); ?>
                            </span>
                            <?php
                        else :
                            ?>
                            <span class="small">
                                <i class="icon-clock"></i>
                                <?php echo $date; ?>
                            </span>
                            <?php
                        endif;
                    ?>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
    <!-- End Items -->

    <?php echo $this->pagination->getListFooter(); ?>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="filter_order" value="<?php echo $list_order; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $list_dir; ?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>