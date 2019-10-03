<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeChunkTool implements ITool
{
    /**
     * Получение набора ячеек которые находятся вокруг переданного центра
     *
     * @param  array $maze    [description]
     * @param  int   $centerX [description]
     * @param  int   $centerY [description]
     *
     * @return array          [description]
     */
    public function getChunkCells(
        array $maze,
        int $centerX,
        int $centerY,
        int $chunkSize
    ): array {
        $cells = [];

        $half = $chunkSize / 2;
        $minX = $centerX - $half;
        $maxX = $centerX + $half;
        $minY = $centerY - $half;
        $maxY = $centerY + $half;

        $countOfXCells = count($maze[0]);
        $countOfYCells = count($maze);

        for ($y = 0; $y < $countOfYCells; $y++) {
            if ($y >= $minY && $y < $maxY) {
                for ($x = 0; $x < $countOfXCells; $x++) {
                    if ($x >= $minX && $x < $maxX) {
                        $cells[] = $maze[$y][$x];
                    }
                }
            }
        }

        return $cells;
    }
}
