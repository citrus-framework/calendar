<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2020, CitrusCalendar. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Citrus\Calendar\Holiday;

use Citrus\Variable\Dates;

/**
 * 日本の暦
 */
class Japanese
{
    /** @var array [年][月][日] => 祝日名称 */
    public const HOLIDAYS = [
        2018 => [
            1 => [
                1 => '元日',
                8 => '成人の日',
            ],
            2 => [
                11 => '建国記念の日',
                12 => '振替休日',
            ],
            3 => [
                21 => '春分の日',
            ],
            4 => [
                29 => '昭和の日',
                30 => '振替休日',
            ],
            5 => [
                3 => '憲法記念日',
                4 => 'みどりの日',
                5 => 'こどもの日',
            ],
            6 => [

            ],
            7 => [
                16 => '海の日',
            ],
            8 => [
                11 => '山の日',
            ],
            9 => [
                17 => '敬老の日',
                23 => '秋分の日',
                24 => '振替休日',
            ],
            10 => [
                8 => '体育の日',
            ],
            11 => [
                3 => '文化の日',
                23 => '勤労感謝の日',
            ],
            12 => [
                23 => '天皇誕生日',
                24 => '振替休日',
            ],
        ],
        2019 => [
            1 => [
                1 => '元日',
                14 => '成人の日',
            ],
            2 => [
                11 => '建国記念の日',
            ],
            3 => [
                21 => '春分の日',
            ],
            4 => [
                29 => '昭和の日',
            ],
            5 => [
                3 => '憲法記念日',
                4 => 'みどりの日',
                5 => 'こどもの日',
                6 => '振替休日',
            ],
            6 => [
            ],
            7 => [
                15 => '海の日',
            ],
            8 => [
                11 => '山の日',
                12 => '振替休日',
            ],
            9 => [
                16 => '敬老の日',
                23 => '秋分の日',
            ],
            10 => [
                14 => '体育の日',
            ],
            11 => [
                3 => '文化の日',
                4 => '振替休日',
                23 => '勤労感謝の日',
            ],
            12 => [
            ],
        ],
        2020 => [
            1 => [
                1 => '元日',
                13 => '成人の日',
            ],
            2 => [
                11 => '建国記念の日',
                23 => '天皇誕生日',
                24 => '振替休日',
            ],
            3 => [
                20 => '春分の日',
            ],
            4 => [
                29 => '昭和の日',
            ],
            5 => [
                3 => '憲法記念日',
                4 => 'みどりの日',
                5 => 'こどもの日',
                6 => '振替休日',
            ],
            6 => [
            ],
            7 => [
                23 => '海の日',
                24 => 'スポーツの日',
            ],
            8 => [
                10 => '山の日',
            ],
            9 => [
                21 => '敬老の日',
                22 => '秋分の日',
            ],
            10 => [
            ],
            11 => [
                3 => '文化の日',
                23 => '勤労感謝の日',
            ],
            12 => [
            ],
        ],
        // 2021年は2020-04-12時点に設定したので後ほど精査の事
        2021 => [
            1 => [
                1 => '元日',
                11 => '成人の日',
            ],
            2 => [
                11 => '建国記念の日',
                23 => '天皇誕生日',
            ],
            3 => [
                20 => '春分の日',
            ],
            4 => [
                29 => '昭和の日',
            ],
            5 => [
                3 => '憲法記念日',
                4 => 'みどりの日',
                5 => 'こどもの日',
            ],
            6 => [
            ],
            7 => [
                19 => '海の日',
            ],
            8 => [
                11 => '山の日',
            ],
            9 => [
                20 => '敬老の日',
                23 => '秋分の日',
            ],
            10 => [
                11 => 'スポーツの日',
            ],
            11 => [
                3 => '文化の日',
                23 => '勤労感謝の日',
            ],
            12 => [
            ],
        ],
    ];



    /**
     * 祝日かどうか
     *
     * @param string $date 日付文字列
     * @return bool true:祝日,false:祝日ではない
     */
    public static function isHoliday(string $date): bool
    {
        $timestamp = strtotime($date);
        $year = (int)date('Y', $timestamp);
        $month = (int)date('n', $timestamp);
        $day = (int)date('j', $timestamp);

        if (true === array_key_exists($year, self::HOLIDAYS)
            and true === array_key_exists($month, self::HOLIDAYS[$year])
            and true === array_key_exists($day, self::HOLIDAYS[$year][$month]))
        {
            return true;
        }
        return false;
    }



    /**
     * 範囲内の祝日を返却する
     *
     * @param string $from 範囲開始(日付文字列Y-m-d)
     * @param string $to 範囲終了(日付文字列Y-m-d)
     * @return array 範囲内の祝日配列 [(日付文字列Y-m-d) => Datesオブジェクト ...]
     */
    public static function during(string $from, string $to): array
    {
        $from_dt = Dates::new($from);
        $to_dt = Dates::new($to);

        $results = [];

        // 範囲ループ
        for ($current_dt = clone $from_dt; $current_dt <= $to_dt; $current_dt->addDay(1))
        {
            $year = (int)$current_dt->format('Y');
            $month = (int)$current_dt->format('n');
            $day = (int)$current_dt->format('j');
            // 存在したらスタック
            if (true === array_key_exists($year, self::HOLIDAYS)
                and true === array_key_exists($month, self::HOLIDAYS[$year])
                and true === array_key_exists($day, self::HOLIDAYS[$year][$month]))
            {
                $results[$current_dt->format('Y-m-d')] = clone $current_dt;
            }
        }
        return $results;
    }
}
