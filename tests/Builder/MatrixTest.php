<?php

namespace App\Tests\Service;

use App\Builder\Matrix;
use PHPUnit\Framework\TestCase;

final class MatrixTest extends TestCase
{
    public function testInvalidLengthTypeThrows()
    {
        $this->expectException(\TypeError::class);
        Matrix::build("test");
    }

    /**
     * @dataProvider matrixLengthProvider
     */
    public function testMatrixValidity($length)
    {
        $matrix = Matrix::build($length);
        $this->assertTrue(is_array($matrix));
        $this->assertEquals($length, count($matrix));
        foreach ($matrix as $key => $row) {
            $this->assertEquals($length, count($row));
        }
    }

    public function matrixLengthProvider(): array
    {
        return [
            [4],
            [52],
            [133],
        ];
    }
}
