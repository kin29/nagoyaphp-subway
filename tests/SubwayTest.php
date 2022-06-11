<?php
declare(strict_types=1);

namespace Shigaayano\Subway\Tests;

use PHPUnit\Framework\TestCase;
use Shigaayano\Subway\Subway;

class SubwayTest extends TestCase
{
    /**
     * @dataProvider getTestData
     */
    public function test(string $input, int $expectedPrice): void
    {
        $SUT = new Subway();
        $this->assertSame($expectedPrice, $SUT->calculate());
    }

    public function getTestData(): array
    {
        return [
            ['A,1,B,2,C|A|B', 210],
            ['A,1,B,2,C|A|C', 270],
            ['W,1,X,1,Y,2,Z|W|X', 210],
            ['W,1,X,1,Y,2,Z|W|Y', 240],
            ['W,1,X,1,Y,2,Z|Z|X', 270],
        ];
    }
}
