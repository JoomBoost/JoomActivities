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


JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');


$list_order = $this->escape($this->state->get('list.ordering'));
$list_dir   = $this->escape($this->state->get('list.direction'));
$can_change = $this->user->authorise('core.edit.state', 'com_joomactivities');

$date_format = $this->params->get('date_format', JText::_('DATE_FORMAT_LC1'));
$date_rel    = (int) $this->params->get('date_relative', 1);
$count = sizeOf($this->items);
?>
<script type="text/javascript">
    Joomla.orderTable = function()
    {
    	table     = document.getElementById("sortTable");
    	direction = document.getElementById("directionTable");
    	order     = table.options[table.selectedIndex].value;

    	if (order != '<?php echo $list_order; ?>') {
    		dirn = 'desc';
    	} else {
    		dirn = direction.options[direction.selectedIndex].value;
    	}

    	Joomla.tableOrdering(order, dirn, '');
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_joomactivities&view=activities'); ?>" method="post" name="adminForm" id="adminForm">
    <?php
    if (!$this->is_j25) :
        if (!empty($this->sidebar)) :
        ?>
               <div id="j-sidebar-container" class="span2">
                  <?php echo $this->sidebar; ?>
               </div>
               <div id="j-main-container" class="span10">
        <?php else : ?>
               <div id="j-main-container">
        <?php
        endif;
    endif;

    echo $this->loadTemplate('filter_j30');
    ?>

    <table class="adminlist table table-striped">
        <thead>
            <th width="1%" class="hidden-phone">
                <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
            </th>
            <th width="1%" style="min-width:55px" class="nowrap center">
                <?php echo JText::_('JSTATUS'); ?>
            </th>
            <th>
                <?php echo JText::_('COM_JOOMACTIVITIES_HEADING_ACTIVITY'); ?>
            </th>
            <th width="20%" class="nowrap">
                <?php echo JHtml::_('grid.sort', 'JDATE', 'a.created', $list_dir, $list_order); ?>
            </th>
            <th width="10%" class="hidden-phone">
                <?php echo JText::_('COM_JOOMACTIVITIES_HEADING_LOCATION'); ?>
            </th>
            <th width="1%" class="nowrap hidden-phone">
                <?php echo JText::_('JGRID_HEADING_ID'); ?>
            </th>
        </thead>
        <tbody>
            <?php
                foreach ($this->items as $i => $item) :
                    $date = JHtml::_('date', $item->created, $date_format);
                    ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td class="hidden-phone">
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="center">
                            <?php echo JHtml::_('jgrid.published', $item->state, $i, 'activities.', $can_change, 'cb'); ?>
                        </td>
                        <td>
                            <?php echo $item->text; ?>
                        </td>
                        <td class="nowrap">
                            <?php
                                if ($date_rel) :
                                    ?>
                                    <span class="label hasTip" title="<?php echo $date; ?>" style="cursor: help;">
                                        <?php echo JoomActivitiesHelper::relativeDateTime($item->created); ?>
                                    </span>
                                    <?php
                                else :
                                    ?>
                                    <span class="label">
                                        <?php echo $date; ?>
                                    </span>
                                    <?php
                                endif;
                            ?>
                        </td>
                        <td class="hidden-phone small">
                            <?php echo $item->client; ?>
                        </td>
                        <td class="hidden-phone small">
                            <?php echo (int) $item->id; ?>
                        </td>
                    </tr>
                <?php
                endforeach;
            ?>
        </tbody>
    </table>

    <?php echo $this->pagination->getListFooter(); ?>

    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="filter_order" value="<?php echo $list_order; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $list_dir; ?>" />
    <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
