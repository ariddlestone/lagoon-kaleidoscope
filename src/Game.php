<?php

namespace ARiddlestone\LagoonKaleidoscope;

class Game
{
    /**
     * @var Tile[]
     */
    protected $tiles = [];

    /**
     * @var Tile[]
     */
    protected $board = [];

    /**
     * @var int[]
     */
    protected $order = [
        0,
        1, 4,
        2, 5, 8,
        3, 6, 9,  12,
           7, 10, 13,
              11, 14,
                  15,
    ];

    public function __construct()
    {
        foreach(require './tiles.php' as $tileConfig) {
            $this->tiles[] = new Tile($tileConfig);
        }
    }

    public function solve()
    {
        /** @var int $n Where are we in the sequence? */
        $n = 0;
        while(array_key_exists($n, $this->order) && array_key_exists($this->order[$n], $this->board)) {
            $n++;
        }
        if(!array_key_exists($n, $this->order)) {
            return true;
        }

        /** @var int $p Which board position are we filling? */
        $p = $this->order[$n];

        foreach($this->tiles as $tile) {
            if(in_array($tile, $this->board)) {
                continue;
            }
            $this->board[$p] = $tile;
            for ($r = 0; $r < 4; $r++) {
                if($this->test() && $this->solve()) {
                    return true;
                }
                $tile->rotateCW();
            }
            unset($this->board[$p]);
        }

        return false;
    }

    protected function test()
    {
        for ($x = 0; $x < 4; $x++) {
            for ($y = 0; $y < 4; $y++) {
                $p = $x + 4 * $y;
                if (empty($this->board[$p])) {
                    continue;
                }

                // north border
                if ($y > 0) {
                    $p2 = $p - 4;
                    if (
                        !empty($this->board[$p2])
                        && $this->board[$p]->getPattern(Tile::ROTATION_NORTH) !== $this->board[$p2]->getPattern(Tile::ROTATION_SOUTH)
                    ) {
                        return false;
                    }
                }

                // east border
                if ($x < 3) {
                    $p2 = $p + 1;
                    if (
                        !empty($this->board[$p2])
                        && $this->board[$p]->getPattern(Tile::ROTATION_EAST) !== $this->board[$p2]->getPattern(Tile::ROTATION_WEST)
                    ) {
                        return false;
                    }
                }

                // south border
                if ($y < 3) {
                    $p2 = $p + 4;
                    if (
                        !empty($this->board[$p2])
                        && $this->board[$p]->getPattern(Tile::ROTATION_SOUTH) !== $this->board[$p2]->getPattern(Tile::ROTATION_NORTH)
                    ) {
                        return false;
                    }
                }

                // west border
                if ($x > 0) {
                    $p2 = $p - 1;
                    if (
                        !empty($this->board[$p2])
                        && $this->board[$p]->getPattern(Tile::ROTATION_WEST) !== $this->board[$p2]->getPattern(Tile::ROTATION_EAST)
                    ) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}
