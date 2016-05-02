<?php
include_once "curl_post/curl_post.php";

$fp = fopen("count.txt", "r+");
$count = (int)fgets($fp);
//echo $count++;
$count++;
$fp = fopen("count.txt", "r+");
fwrite($fp, $count);
fclose($fp);
$year = $_GET['y'];
$term = $_GET['t'];
$reminder = $_GET['r'];
$reminder_t = $_GET['rt'];

vlogin("http://202.118.201.228/academic/student/currcourse/currcourse.jsdo?groupId=&moduleId=2000");

$start_url = "http://202.118.201.228/academic/calendar/calendarViewList.do?groupId=&sortColumn=year&moduleId=400&sortDirection=-1&pagingPage=1&pagingNumberPer=100";
$content = vlogin($start_url);
//echo $start_url;
//echo $content;


$pattern = '/start_year=parseInt\((\d+)\);/';
if (1 != preg_match($pattern, $content, $match)) {
    echo "请检查输入的<strong>验证码</strong>是否正确。请返回，刷新网页重试。如果多次尝试还是失败，请联系我，邮箱：moonsn1994@gmail.com";
    exit();
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

//echo "开始日期：$start_year $start_month $start_day 周数：$start_weeks";


$start_date = mktime(0,0,0,$start_month, $start_day, $start_year);

//echo getWeekTime($start_date, 1);
function getWeekTime($start, $week) {
    $aweek = 604800;
    $start += $aweek * ($week - 1);
    return date('Y-m-d', $start);
}


$str = "";

for ($w = 1; $w <= $start_weeks; $w++) {
    $courses = getCourseOfAweek($w);
    $num = sizeof($courses);
    for ($c = 0; $c < $num; $c++) {
        if ($courses[$c]['other'] == '停课') {
            continue;
        }
        $str .= display($courses[$c]);
    }
}

header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="downloaded.ics"');
echo "BEGIN:VCALENDAR\nVERSION:2.0\nX-WR-CALNAME:课程\n".$str."\nEND:VCALENDAR";

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
        $temp = $matchs[2][$row * 12 + 0];
        if ($temp == "") {
            /* 日期为空就是整周事件 */
            $start_date = $GLOBALS['start_date'];
            $temp = getWeekTime($start_date, $week); /* the begin of this week */
            $c[$row]['endweek'] = getWeekTime($start_date, $week + 1); /* the begin of next week */
            $c[$row]['allweek'] = true; /* 整周事件标记 */
        }
        $c[$row]['date'] = $temp;
        $c[$row]['name'] = $matchs[2][$row * 12 + 1];
        $c[$row]['shuxing'] = $matchs[2][$row * 12 + 2];
        $c[$row]['kaoshishuxing'] = $matchs[2][$row * 12 + 3];
        $c[$row]['week'] = $matchs[2][$row * 12 + 5];
        $c[$row]['jieci'] = $matchs[2][$row * 12 + 5];
        $c[$row]['start'] = $matchs[2][$row * 12 + 7] == "" ? '00:00' : $matchs[2][$row * 12 + 7];
        $c[$row]['end'] = $matchs[2][$row * 12 + 8] == "" ? '23:59:59' : $matchs[2][$row * 12 + 8];
        $c[$row]['place'] = $matchs[2][$row * 12 + 9] == "" ? '地点待定' : $matchs[2][$row * 12 + 9];
        $c[$row]['classroom'] = $matchs[2][$row * 12 + 10] == "" ? '教室待定' : $matchs[2][$row * 12 + 10];
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
    if ($course['allweek'] == true) {
        $course['endweek'] = str_replace('-', '', $course['endweek']);
        $etime = $course['endweek'].'T000000'; /* 下周的开始 */
    }

    $summary = $course['name'].' - ('.$course['classroom'].')';
    $location = $course['place'].' - '.$course['classroom'];

    $desc = $course['desc'];

    $event = "";
    $uid = $stime.$etime.'-'.rand(10000,99999);

    $event .= "\nBEGIN:VEVENT";
    $event .= "\nUID:$uid";
    $event .= "\nDTSTART;TZID=Asia/Shanghai:$stime";
    $event .= "\nDTEND;TZID=Asia/Shanghai:$etime";
    $event .= "\nSUMMARY:$summary";
    $event .= "\nLOCATION:$location";
    $event .= "\nDESCRIPTION:$desc";
    if ($GLOBALS['reminder'] == 'on') {
        $event .= "\nBEGIN:VALARM";
        $event .= "\nTRIGGER:-PT{$GLOBALS['reminder_t']}M";
        $event .= "\nACTION:DISPLAY";
        $event .= "\nDESCRIPTION: 【$summary 】还有{$GLOBALS['reminder_t']}分钟就要开始了！";
        $event .= "\nEND:VALARM";
    }
    $event .= "\nEND:VEVENT";
    return $event;
}




 ?>
