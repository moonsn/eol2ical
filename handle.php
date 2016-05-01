<?php
include_once "curl_post/curl_post.php";


vlogin("http://202.118.201.228/academic/student/currcourse/currcourse.jsdo?groupId=&moduleId=2000");

$content = vget("http://202.118.201.228/academic/calendar/calendarViewList.do?groupId=&sortColumn=year&moduleId=400&termid=1&yearid=36&sortDirection=-1&pagingPage=1&pagingNumberPer=100");


$pattern = '/start_year=parseInt\((\d+)\);/';
if (1 != preg_match($pattern, $content, $match)) {
    echo "没有匹配到年份";
}
$start_year = $match[1];
$pattern = '/start_month=parseInt\((\d+)\);/';
if (1 != preg_match($pattern, $content, $match)) {
    echo "没有匹配到月";
}
$start_month = $match[1];
$pattern = '/start_day=parseInt\((\d+)\);/';
if (1 != preg_match($pattern, $content, $match)) {
    echo "没有匹配到日";
}
$start_day = $match[1];
$pattern = '/weeks=parseInt\((\d+)\);/';
if (1 != preg_match($pattern, $content, $match)) {
    echo "没有匹配到周数";
}
$start_weeks = $match[1];

echo "开始日期：$start_year $start_month $start_day 周数：$start_weeks";


/*
$str = "";

for ($w = 1; $w <= 25; $w++) {
    $courses = getCourseOfAweek($w);
    $num = sizeof($courses);
    for ($c = 0; $c < $num; $c++) {
        if ($susr)
        $str .= display($courses[$c]);
    }
}

header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="downloaded.ics"');
echo "BEGIN:VCALENDAR\nVERSION:2.0\n".$str."\nEND:VCALENDAR";
*/

function getCourseOfAweek($week) {

    # get content
    $post_data = "yearid=36&termid=1&whichWeek=$week";
    $post_url = "http://202.118.201.228/academic/manager/coursearrange/studentWeeklyTimetable.do?".$post_data;
    $content = vlogin($post_url);
    //var_dump($content);

    $p = '/<td name="(.+)">([^<]+)?<\/td>/';

    if (0 == preg_match_all($p, $content, $matchs)) {
        //echo "错误: 没有匹配到课程，可能 $week 周没有课\n";
        //var_dump($matchs);
    }

    $number_course = sizeof($matchs[0]) / 12;
    //echo "第 $whichWeek 共 $number_course 节课";

    $c = array();
    for ($row = 0; $row < $number_course; $row++) {
        $c[$row]['date'] = $matchs[2][$row * 12 + 0];
        $c[$row]['name'] = $matchs[2][$row * 12 + 1];
        $c[$row]['shuxing'] = $matchs[2][$row * 12 + 2];
        $c[$row]['kaoshishuxing'] = $matchs[2][$row * 12 + 3];
        $c[$row]['week'] = $matchs[2][$row * 12 + 5];
        $c[$row]['jieci'] = $matchs[2][$row * 12 + 5];
        $c[$row]['start'] = $matchs[2][$row * 12 + 7];
        $c[$row]['end'] = $matchs[2][$row * 12 + 8];
        $c[$row]['place'] = $matchs[2][$row * 12 + 9];
        $c[$row]['classroom'] = $matchs[2][$row * 12 + 10];
        $c[$row]['other'] = $matchs[2][$row * 12 + 11];
        $c[$row]['desc'] = $week % 2 == 1 ? '单周' : '双周';
    }

    return $c;
}


function display($course) {

    # change date format
    $date = str_replace('-', '', $course['date']);
    //echo $course['date'];
    $stime = str_replace(':', '', $course['start']);
    $etime = str_replace(':', '', $course['end']);
    $stime = $date.'T'.$stime.'00';
    $etime = $date.'T'.$etime.'00';

    $summary = $course['name'].'-'.$course['classroom'];
    $location = $course['place'].'-'.$course['classroom'];

    $desc = $course['desc'];

    $event = "";

    $event .= "\nBEGIN:VEVENT";
    $event .= "\nDTSTART;TZID=Asia/Shanghai:$stime";
    $event .= "\nDTEND;TZID=Asia/Shanghai:$etime";
    $event .= "\nSUMMARY:$summary";
    $event .= "\nLOCATION:$location";
    $event .= "\nDESCRIPTION:$desc";
    $event .= "\nEND:VEVENT";
    return $event;
}




 ?>
