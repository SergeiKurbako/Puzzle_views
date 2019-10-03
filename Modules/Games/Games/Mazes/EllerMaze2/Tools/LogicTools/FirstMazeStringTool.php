<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class FirstMazeStringTool implements ITool
{
    public function getFirstMazeString(int $width): array
    {
        // first string filling
        $mazeString = $this->fillingFirstString($width);

        // объединяем ячейки
        $mazeString = $this->unionCells($mazeString);

        return $mazeString;
    }

    public function fillingFirstString(int $width): array
    {
        $newMazeString = [];

        for ($i = 0; $i < $width; $i++) {
            $newMazeString[] = [
                'topWall' => true,
                'rightWall' => true,
                'set' => $i
            ];
        }

        return $newMazeString;
    }

    public function unionCells(array $mazeString): array
    {
        $count = count($mazeString) - 2;
        for ($i = 0; $i < $count; $i++) {
            $rand = rand(0, 1);

            if ($rand === 1) {
                $mazeString[$i]['rightWall'] = false;

                $mazeString[$i + 1]['set'] = $mazeString[$i]['set'];
            }
        }

        return $mazeString;
    }

}
