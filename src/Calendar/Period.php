<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2020, CitrusCalendar. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus\Calendar;

/**
 * カレンダーの旬
 */
class Period
{
    /** 上旬 */
    public const FIRST = 'first';

    /** 中旬 */
    public const SECOND = 'second';

    /** 下旬 */
    public const LAST = 'last';



    /**
     * 日付文字列から旬を判定し返却する
     *
     * @param string $date 日付文字列
     * @return string
     */
    public static function period(string $date): string
    {
        return self::periodByTimestamp(strtotime($date));
    }



    /**
     * タイムスタンプから旬を判定し返却する
     *
     * @param int $timestamp UNIXタイムスタンプ
     * @return string
     */
    public static function periodByTimestamp(int $timestamp): string
    {
        $day = date('j', $timestamp);

        // 10日以前
        if (10 >= $day)
        {
            return self::FIRST;
        }
        // 20日以前
        if (20 >= $day)
        {
            return self::SECOND;
        }
        // それ以外
        return self::LAST;
    }
}
