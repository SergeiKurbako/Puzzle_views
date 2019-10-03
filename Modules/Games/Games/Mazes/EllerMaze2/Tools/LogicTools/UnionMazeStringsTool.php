<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class UnionMazeStringsTool implements ITool
{
    public function union(array $otherMazeStrings, array $lastMazeString): array
    {
        $unionArray = [];

        foreach ($otherMazeStrings as $key => $mazeString) {
            $unionArray[] = $mazeString;
        }

        $unionArray[] = $lastMazeString;

        return $unionArray;
    }
}
