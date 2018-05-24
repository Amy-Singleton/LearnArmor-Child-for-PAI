jQuery(document).ready(function($){
        $('span.completed.glyphicon').removeClass('glyphicon-unchecked');
        $('span.completed.glyphicon' ).addClass('glyphicon-check');
        $('span.notcompleted.glyphicon').addClass('glyphicon-unchecked');
        $('span.notcompleted.glyphicon' ).removeClass('glyphicon-check'); 
        $('span.topic-completed.glyphicon').removeClass('glyphicon-unchecked');
        $('span.topic-completed.glyphicon' ).addClass('glyphicon-check');
        $('span.topic-notcompleted.glyphicon').addClass('glyphicon-unchecked');
        $('span.topic-notcompleted.glyphicon' ).removeClass('glyphicon-check');     
});

