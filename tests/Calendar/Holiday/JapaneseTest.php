<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2020, CitrusCollection. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Test\Calendar\Holiday;

use Citrus\Calendar\Holiday\Japanese;
use Citrus\Variable\Dates;
use PHPUnit\Framework\TestCase;

/**
 * 日本の暦クラスのテスト
 */
class JapaneseTest extends TestCase
{
    /**
     * @test
     */
    public function isHoliday_想定通り()
    {
        // 昭和の日(2020-04-29)
        $this->assertTrue(Japanese::isHoliday('2020-04-29'));
        // 平日(2020-04-13)
        $this->assertFalse(Japanese::isHoliday('2020-04-13'));
        // おそらく昭和の日だが未定義(2022-04-29)
        $this->assertFalse(Japanese::isHoliday('2022-04-29'));
    }



    /**
     * @test
     */
    public function during_想定通り()
    {
        // 2020年の9月は祝日が2日


        // 検算
        $this->assertEquals([
                '2020-09-21' => Dates::new('2020-09-21'),
                '2020-09-22' => Dates::new('2020-09-22'),
            ],
            Japanese::during('2020-09-01', '2020-09-30')
        );
    }
}
