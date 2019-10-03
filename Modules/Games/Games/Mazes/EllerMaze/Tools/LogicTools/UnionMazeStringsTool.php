<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class UnionMazeStringsTool implements ITool
{
    public function union(array $firstMazeString, array $otherMazeStrings): array
    {
        $unionArray = [];
        //$unionArray[] = $firstMazeString;

        foreach ($otherMazeStrings as $key => $mazeString) {
            $unionArray[] = $mazeString;
        }

        return $unionArray;
    }
}
