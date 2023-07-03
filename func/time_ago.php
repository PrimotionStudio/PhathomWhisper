<?php
define("TIMEBEFORE_NOW", 'just now');
define("TIMEBEFORE_SECOND", '{num} second ago');
define("TIMEBEFORE_SECONDS", '{num} seconds ago');
define("TIMEBEFORE_MINUTE", '{num} minute ago');
define("TIMEBEFORE_MINUTES", '{num} minutes ago');
define("TIMEBEFORE_HOUR", '{num} hour ago');
define("TIMEBEFORE_HOURS", '{num} hours ago');
define("TIMEBEFORE_YESTERDAY", 'yesterday');
define("TIMEBEFORE_DAY", '{num} day ago');
define("TIMEBEFORE_DAYS", '{num} days ago');
define("TIMEBEFORE_WEEK", '{num} week ago');
define("TIMEBEFORE_WEEKS", '{num} weeks ago');
define("TIMEBEFORE_MONTH", '{num} month ago');
define("TIMEBEFORE_MONTHS", '{num} months ago');
define("TIMEBEFORE_YEAR", '{num} year ago');
define("TIMEBEFORE_YEARS", '{num} years ago');

function time_ago($time)
{
    $out    = '';
    $now    = time();
    $diff   = $now - $time;

    if ($diff < 2)
        return TIMEBEFORE_NOW;

    elseif ($diff < 60)
        return str_replace('{num}', ($out = $diff), $out == 1 ? TIMEBEFORE_SECOND : TIMEBEFORE_SECONDS);

    elseif ($diff < 60 * 60)
        return str_replace('{num}', ($out = round($diff / 60)), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES);

    elseif ($diff < 24 * 60 * 60)
        return str_replace('{num}', ($out = round($diff / (60 * 60))), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS);

    elseif ($diff < 48 * 60 * 60)
        return TIMEBEFORE_YESTERDAY;

    elseif ($diff < 7 * 24 * 60 * 60)
        return str_replace('{num}', round($diff / (24 * 60 * 60)), $out == 1 ? TIMEBEFORE_DAY : TIMEBEFORE_DAYS);

    elseif ($diff < 30 * 24 * 60 * 60)
        return str_replace('{num}', ($out = round($diff / (7 * 24 * 60 * 60))), $out == 1 ? TIMEBEFORE_WEEK : TIMEBEFORE_WEEKS);

    elseif ($diff < 365 * 24 * 60 * 60)
        return str_replace('{num}', ($out = round($diff / (30 * 24 * 60 * 60))), $out == 1 ? TIMEBEFORE_MONTH : TIMEBEFORE_MONTHS);

    else
        return str_replace('{num}', ($out = round($diff / (365 * 24 * 60 * 60))), $out == 1 ? TIMEBEFORE_YEAR : TIMEBEFORE_YEARS);
}

?>