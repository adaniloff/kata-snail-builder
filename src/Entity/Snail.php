<?php

namespace App\Entity;

use App\Builder\SnailMatrix;

final class Snail
{
    const MIN_LENGTH = 1;

    const ERR_MSG_INVALID_LENGTH = "Length must be greaterOrEqual than " . self::MIN_LENGTH;

    private $length;
    private $map;

    public function __construct(int $length)
    {
        if (self::MIN_LENGTH > $length) {
            throw new \InvalidArgumentException(self::ERR_MSG_INVALID_LENGTH);
        }

        $this->length = $length;
    }

    public function serve(): array
    {
        if (!$this->map) {
            $this->build();
        }

        return $this->map;
    }

    private function build(): void
    {
        $matrix = new SnailMatrix();
        $this->map = $matrix->build($this->length);
    }

    public function getMin(): int
    {
        return 1;
    }

    public function getMax(): int
    {
        return $this->length * $this->length;
    }
}
