<?php
    if(!function_exists('compareTime')){
        function compareTime($dateTime){
            if(!empty($dateTime)){
                $timeNow = time();
                $dateTime = strtotime($dateTime);
                $time = $timeNow - $dateTime;
                switch($time){
                    // Today
                    case $time <= 86400;
                    return 'To day';
                    // days
                    case $time >= 86400 && $time < 604800;
                    return (round($time/86400) == 1) ? 'Yesterday' : round($time/86400).' days ago';
                    // weeks
                    case $time >= 604800 && $time < 2600640;
                    return (round($time/604800) == 1) ? '1 week ago' : round($time/604800).' weeks ago';
                    // months
                    case $time >= 2600640 && $time < 31207680;
                    return (round($time/2600640) == 1) ? '1 month ago' : round($time/2600640).' months ago';
                    // years
                    case $time >= 31207680;
                    return (round($time/31207680) == 1) ? '1 year ago' : round($time/31207680).' years ago' ;
                }
            }
            return 'Not found time create!';
        }
    }
?>