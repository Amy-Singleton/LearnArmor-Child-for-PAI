<?php

/**
 * Change the Wordpress Default From Name and Email Address for Emails
 * @link https://www.daretothink.co.uk/change-default-wordpress-email-address/
 */ 
function learnarmor_child_new_mail_from($old) {
    return 'info@psycharmor.org';
}
add_filter('wp_mail_from', 'learnarmor_child_new_mail_from');
function learnarmor_child_new_mail_from_name($old) {
    return 'PsychArmor Institute';
}
add_filter('wp_mail_from_name', 'learnarmor_child_new_mail_from_name');