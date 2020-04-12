<?php

declare(strict_types=1);

/**
 * @copyright   Copyright 2020, CitrusCollection. All Rights Reserved.
 * @author      take64 <take64@citrus.tk>
 * @license     http://www.citrus.tk/
 */

namespace Test\Calendar;

use Citrus\Calendar\Period;
use PHPUnit\Framework\TestCase;

/**
 * カレンダー旬クラスのテスト
 */
class PeriodTest extends TestCase
{
    /**
     * @test
     */
    public function period_想定通り()
    {
        // 上旬
        $this->assertSame(Period::FIRST, Period::period('2020-04-10'));
        // 中旬
        $this->assertSame(Period::SECOND, Period::period('2020-04-11'));
        // 下旬
        $this->assertSame(Period::LAST, Period::period('2020-03-31'));
    }
}
