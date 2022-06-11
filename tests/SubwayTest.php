<?php
declare(strict_types=1);

namespace Kin29\Subway\Tests;

use PHPUnit\Framework\TestCase;
use Kin29\Subway\Subway;

class SubwayTest extends TestCase
{
    /**
     * @dataProvider getTestData
     */
    public function test(string $input, int $expectedPrice): void
    {
        $SUT = new Subway();
        $this->assertSame($expectedPrice, $SUT->calculate($input));
    }

    public function getTestData(): array
    {
        return [
            //[ルート(駅,距離ポイント....)|出発駅|到着駅, 料金]
            ['A,1,B,2,C|A|B', 210],
            ['A,1,B,2,C|A|C', 270],
            ['W,1,X,1,Y,2,Z|W|X', 210],
            ['W,1,X,1,Y,2,Z|W|Y', 240],
            ['W,1,X,1,Y,2,Z|Z|X', 270],
        ];
    }
}
