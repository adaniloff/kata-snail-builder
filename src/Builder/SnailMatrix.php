<?php

namespace App\Builder;

class SnailMatrix
{
    private const DIR_RIGHT = "right";
    private const DIR_BOTTOM = "bottom";
    private const DIR_LEFT = "left";
    private const DIR_TOP = "top";

    private $matrix = [];

    private $maxLength;
    private $currentIndex = 1;

    private $cursorDirection = self::DIR_RIGHT;
    private $cursorCoordinates = [
        "x" => 0,
        "y" => 0,
    ];

    public function build(int $length): array
    {
        $this->matrix = Matrix::build($length);
        $this->maxLength = $length * $length;

        do {
            $this->matrix[$this->cursorCoordinates["y"]][$this->cursorCoordinates["x"]] = $this->currentIndex;
        } while (++$this->currentIndex <= $this->maxLength && null === $this->moveCursor());

        return $this->matrix;
    }

    private function moveCursor(): void
    {
        $this->handleCursorDirection();

        switch ($this->cursorDirection) {
            case self::DIR_RIGHT:
                $this->cursorCoordinates["x"]++;
                break;
            case self::DIR_BOTTOM:
                $this->cursorCoordinates["y"]++;
                break;
            case self::DIR_LEFT:
                $this->cursorCoordinates["x"]--;
                break;
            case self::DIR_TOP:
                $this->cursorCoordinates["y"]--;
                break;
        }
    }

    private function handleCursorDirection(): void
    {
        switch ($this->cursorDirection) {
            case self::DIR_RIGHT:
                if (!isset($this->matrix[$this->cursorCoordinates["y"]][$this->cursorCoordinates["x"] + 1])
                    || Matrix::DEFAULT_EMPTY_VALUE !== $this->matrix[$this->cursorCoordinates["y"]][$this->cursorCoordinates["x"] + 1]) {
                    $this->cursorDirection = self::DIR_BOTTOM;
                }
                break;
            case self::DIR_BOTTOM:
                if (!isset($this->matrix[$this->cursorCoordinates["y"] + 1])
                    || Matrix::DEFAULT_EMPTY_VALUE !== $this->matrix[$this->cursorCoordinates["y"] + 1][$this->cursorCoordinates["x"]]) {
                    $this->cursorDirection = self::DIR_LEFT;
                }
                break;
            case self::DIR_LEFT:
                if (!isset($this->matrix[$this->cursorCoordinates["y"]][$this->cursorCoordinates["x"] - 1])
                    || Matrix::DEFAULT_EMPTY_VALUE !== $this->matrix[$this->cursorCoordinates["y"]][$this->cursorCoordinates["x"] - 1]) {
                    $this->cursorDirection = self::DIR_TOP;
                }
                break;
            case self::DIR_TOP:
                if (!isset($this->matrix[$this->cursorCoordinates["y"] - 1])
                    || Matrix::DEFAULT_EMPTY_VALUE !== $this->matrix[$this->cursorCoordinates["y"] - 1][$this->cursorCoordinates["x"]]) {
                    $this->cursorDirection = self::DIR_RIGHT;
                }
                break;
        }
    }
}
