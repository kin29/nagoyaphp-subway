<?php
declare(strict_types=1);

namespace Shigaayano\Subway\Tests;

use PHPUnit\Framework\TestCase;
use Shigaayano\Subway\Subway;

class SubwayTest extends TestCase
{
    public function test(): void
    {
        $SUT = new Subway();
        $this->assertSame('hoge', $SUT->getHoge());
    }
}
