<?php

namespace App\Builder;

abstract class Matrix
{
    protected const DEFAULT_EMPTY_VALUE = "@";

    public function build(int $length)
    {
        return self::serve($length);
    }

    final static public function serve(int $length)
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
