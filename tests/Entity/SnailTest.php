<?php

namespace App\Tests\Service;

use App\Entity\Snail;
use PHPUnit\Framework\TestCase;

final class SnailTest extends TestCase
{
    private const SNAIL4_LENGTH_TESTING_VALUE = 4;
    private const SNAIL4_MIN_VALUE = 1;
    private const SNAIL4_MAX_VALUE = self::SNAIL4_LENGTH_TESTING_VALUE * self::SNAIL4_LENGTH_TESTING_VALUE;
    private const SNAIL4_MAP = [
        [1,  2,  3,  4],
        [12, 13, 14, 5],
        [11, 16, 15, 6],
        [10,  9,  8, 7],
    ];

    public function testInvalidLengthTypeThrows()
    {
        $this->expectException(\TypeError::class);
        new Snail("test");
    }

    public function testEmptyLengthThrows()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(Snail::ERR_MSG_INVALID_LENGTH);
        new Snail(0);
    }

    public function testLengthMinIs1()
    {
        $snail = new Snail(1);

        $refSnailLength = new \ReflectionProperty($snail, "length");
        $refSnailLength->setAccessible(true);

        $this->assertEquals(Snail::MIN_LENGTH, $refSnailLength->getValue($snail));
    }

    public function testResultInstanceOfSnail(): Snail
    {
        $snail = new Snail(self::SNAIL4_LENGTH_TESTING_VALUE);
        $this->assertTrue($snail instanceof Snail);

        return $snail;
    }

    /**
     * @depends testResultInstanceOfSnail
     */
    public function testResultFormattedArray(Snail $snail): array
    {
        $snailMap = $snail->serve();

        $this->assertTrue(is_array($snailMap));

        return $snailMap;
    }

    /**
     * @depends testResultFormattedArray
     */
    public function testResultFormattedArrayCountIsValid(array $snailMap)
    {
        $this->assertEquals(self::SNAIL4_LENGTH_TESTING_VALUE, count($snailMap));
    }

    /**
     * @depends testResultInstanceOfSnail
     */
    public function testResultMin(Snail $snail)
    {
        $this->assertEquals(self::SNAIL4_MIN_VALUE, $snail->getMin());
    }

    /**
     * @depends testResultInstanceOfSnail
     */
    public function testResultMax(Snail $snail)
    {
        $this->assertEquals(self::SNAIL4_MAX_VALUE, $snail->getMax());
    }

    /**
     * @depends testResultInstanceOfSnail
     */
    public function testResultMap(Snail $snail)
    {
        $snailMap = $snail->serve();
        $this->assertEquals(self::SNAIL4_MAP, $snailMap);
    }
}
