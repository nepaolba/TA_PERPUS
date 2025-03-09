
<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('time_ago')) {
    function time_ago($datetime)
    {
        $CI = &get_instance();
        $CI->load->helper('date');

        $time_ago = strtotime($datetime);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;

        // echo $current_time;
        $minutes      = floor($seconds / 60);           // value 60 is seconds
        $hours        = floor($seconds / 3600);         // value 3600 is 60 minutes * 60 sec
        $days         = floor($seconds / 86400);        // value 86400 is 24 * 60 * 60
        $weeks        = floor($seconds / 604800);       // value 604800 is 7 * 24 * 60 * 60
        $months       = floor($seconds / 2629440);      // value 2629440 is (365+0.25)/12 * 24 * 60 * 60
        $years        = floor($seconds / 31553280);     // value 31553280 is 365 * 24 * 60 * 60


        if ($seconds <= 60) {
            return "Baru saja";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 min ago";
            } else {
                return "$minutes min ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "1 hour ago";
            } else {
                return "$hours hour ago ";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "Yester Day";
            } else {
                return "$days day ago";
            }
        } else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "1 week ago";
            } else {
                return "$weeks week ago";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "1 month ago";
            } else {
                return "$months month ago";
            }
        } else {
            if ($years == 1) {
                return "1 year ago";
            } else {
                return "$years year ago";
            }
        }
    }
}
