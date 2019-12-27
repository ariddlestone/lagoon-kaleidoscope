<?php

namespace ARiddlestone\LagoonKaleidoscope;

class Tile
{
    const ROTATION_NORTH = 0;
    const ROTATION_WEST = 1;
    const ROTATION_SOUTH = 2;
    const ROTATION_EAST = 3;

    protected $patterns;

    protected $rotation = self::ROTATION_NORTH;

    public function __construct($tileConfig = null)
    {
        $this->patterns = $tileConfig;
    }

    /**
     * @return int
     */
    public function getRotation()
    {
        return $this->rotation;
    }

    public function rotateCW()
    {
        $this->rotation += 1;
        $this->rotation %= 4;
    }

    public function rotateCCW()
    {
        $this->rotation += 3;
        $this->rotation %= 4;
    }

    public function getPattern($side)
    {
        $side += $this->rotation;
        $side %= 4;
        return $this->patterns[$side];
    }

    public function __toString()
    {
        return $this->getPattern(0)
            . $this->getPattern(1)
            . $this->getPattern(2)
            . $this->getPattern(3);
    }
}
