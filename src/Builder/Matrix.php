<?php

namespace App\Builder;

final class Matrix
{
    public const DEFAULT_EMPTY_VALUE = false;

    final static public function build(int $length)
    {
        $matrix = [];
        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length; $j++) {
                $matrix[$i][$j] = self::DEFAULT_EMPTY_VALUE;
            }
        }

        return $matrix;
    }
}
