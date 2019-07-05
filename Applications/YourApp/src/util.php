<?php
/**
 * 获取今日零点的时间戳
 */
function get_today_zero_time(){
    return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
}

/**
 * 返回本周开始的时间戳
 */
function get_week_zero_time()
{
    $timestamp = time();
    return strtotime(date('Y-m-d', strtotime("this week Monday", $timestamp)));
}

/**
 * 返回本月开始的时间戳
 */
function get_month_zero_time()
{
    return  mktime(0, 0, 0, date('m'), 1, date('Y'));
}