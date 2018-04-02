<?php
$stats = lds_get_user_stats( $lessons, $lesson_topics, $quizzes ); ?>
<div id="learndash_enhanced_course_header" <?php lds_enhanced_course_header_background($course_status); ?>>

    <hgroup>
         <h2 class="col-sm-6"><?php echo LearnDash_Custom_Label::get_label( 'course' ) ?> <?php esc_html_e( 'Status', 'sfwd-lms' ); ?></h2>
        <p class="col-sm-6 lds-enhanced-course-status"><?php echo esc_html($course_status); ?></p>
       
    </hgroup>

    <?php if( ( $course_status == 'In Progress' || $course_status == 'completed' ) && get_option( 'lds_show_leaderboard', 'yes' ) == 'yes' ): ?>
        <ul class="lds_stats">
            <?php
            foreach ($stats as $label => $values):
                if( $values['total'] == 0 ) continue;
                ?>
                <li>
                    <span><?php echo esc_html( $values['completed'] . '/' . $values['total'] ); ?></span>
                    <strong><?php echo esc_html($values['title']); ?></strong>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>
