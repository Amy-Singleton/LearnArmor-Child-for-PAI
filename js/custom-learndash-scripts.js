jQuery(document).ready(function($){
        $('span.completed.glyphicon').removeClass('glyphicon-unchecked');
        $('span.completed.glyphicon' ).addClass('glyphicon-check');
        $('span.notcompleted.glyphicon').addClass('glyphicon-unchecked');
        $('span.notcompleted.glyphicon' ).removeClass('glyphicon-check'); 
        $('span.topic-completed.glyphicon').removeClass('glyphicon-unchecked');
        $('span.topic-completed.glyphicon' ).addClass('glyphicon-check');
        $('span.topic-notcompleted.glyphicon').addClass('glyphicon-unchecked');
        $('span.topic-notcompleted.glyphicon' ).removeClass('glyphicon-check');
        if (screen.width < 1440) {
                $('div.course-description > div.course-thumbnail' ).removeClass('col-sm-4');
                $('div.course-description > div.course-thumbnail' ).addClass('col-sm-6');
                $('div.course-description > div.course-excerpt' ).removeClass('col-sm-8');
                $('div.course-description > div.course-excerpt' ).addClass('col-sm-6');                
        }
});

