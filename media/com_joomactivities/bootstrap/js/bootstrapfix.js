jQuery(document).ready(function($){
    $ = jQuery.noConflict();
    var bsPopover = $.fn['bspopover'].noConflict();
    $.fn.popover = bsPopover;

    var bsTooltip = $.fn['bstooltip'].noConflict();
    $.fn.tooltip = bsTooltip;
    jQuery('[data-toggle="tooltip"]').tooltip({
        animation: false,
        container: '#jb-template',
        html: false
    });
    jQuery('[data-toggle="tooltip"]').on('hidden.bs.tooltip', function (e) {
        jQuery(this).show();
    });
    initPopover4();

});
function initPopover4(){

    jQuery('[data-toggle="popover"]').popover({
        trigger: 'hover',
        container: '#jb-template',
        animation: false,
        html: true,
        sanitize : false
    });

    jQuery('[data-toggle="popover"]').on('hidden.bs.popover', function (e) {
        jQuery(this).show();
    });

    jQuery('[data-toggle="popover"]').on('show.bs.popover', function (e) {
        jQuery(this).show();
    });
}