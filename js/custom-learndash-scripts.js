jQuery(document).ready(function($){
        $('span.completed.glyphicon').removeClass('glyphicon-unchecked');
        $('span.completed.glyphicon' ).addClass('glyphicon-check');
        $('span.notcompleted.glyphicon').addClass('glyphicon-unchecked');
        $('span.notcompleted.glyphicon' ).removeClass('glyphicon-check');
        $('div.vp-controls > button').attr('tabindex', '0');
});