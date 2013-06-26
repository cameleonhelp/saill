$(document).ready(function () {
    $('.accordionMod').each(function(index) {
        var thisBox = $(this).children(),
            thisMainIndex = index + 1;
        $(this).attr('id', 'accordion' + thisMainIndex);
        
        thisBox.each(function(i) {
        var thisIndex = i + 1,
                thisParentIndex = thisMainIndex,
                thisMain = $(this).parent().attr('id'),
                thisTriggers = $(this).find('.accordion-toggle'),
                thisBoxes = $(this).find('.accordion-inner'); 
            var isheadactive = $(this).is('.indiv') ? 'left_active_head' : '';
            $(this).addClass('accordion-group');
            var isopen = $(this).is('.indiv') ? 'in' : '';
            thisBoxes.wrap('<div id=\"collapseBox' + thisParentIndex + '_' + thisIndex + '\" class=\"accordion-body collapse '+isopen+'\" />');
            thisTriggers.wrap('<div class=\"accordion-heading '+isheadactive+'\" />');
            thisTriggers.attr('data-toggle', 'collapse').attr('data-parent', '#' + thisMain).attr('data-target', '#collapseBox' + thisParentIndex + '_' + thisIndex);
             if (isopen == 'in'){
                 thisTriggers.addClass('current');
             }
         });
        var isactive = $('.accordionMod .accordion-toggle').is('.current') ? 'iconActive' : '';
        $('.accordionMod .accordion-toggle').prepend('<span class=\"icon pull-right\" />');
        
        thisBox.each(function(i) {
            var thisTriggers = $(this).find('.accordion-toggle');
            var isopen = $(this).is('.indiv') ? 'in' : '';
            if (isopen == 'in'){
                 thisTriggers.find('.icon').addClass('iconActive');
             }
        });
        
        $('.accordionMod .accordion-toggle').click(function() {
            if ($(this).parent().parent().find('.accordion-body').is('.in')) {
                $(this).removeClass('current');
                $(this).find('.icon').removeClass('iconActive');
            } else {
                $(this).addClass('current');
                $(this).find('.icon').addClass('iconActive');
            }
            $(this).parent().parent().siblings().find('.accordion-toggle').removeClass('current');
            $(this).parent().parent().siblings().find('.accordion-toggle > .icon').removeClass('iconActive');
        });
    });
});