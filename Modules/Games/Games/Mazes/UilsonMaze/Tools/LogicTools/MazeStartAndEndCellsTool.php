<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeStartAndEndCellsTool implements ITool
{
    public function addStartAndEndPointInMaze(
        array $maze,
        int $startCellX,
        int $startCellY,
        int $endCellX,
        int $endCellY
    ): array {
        $maze[$startCellY][$startCellX] = [
            'rightWall' => false,
            'bottomWall' => false,
            'cellX' => $startCellX,
            'cellY' => $startCellY,
            'healthBonus' => false,
            'speedBonus' => false,
            'timeBonus' => false
        ];

        $maze[$endCellY][$endCellX] = [
            'rightWall' => false,
            'bottomWall' => false,
            'cellX' => $endCellX,
            'cellY' => $endCellY,
            'healthBonus' => false,
            'speedBonus' => false,
            'timeBonus' => false
        ];

        return $maze;
    }
}
