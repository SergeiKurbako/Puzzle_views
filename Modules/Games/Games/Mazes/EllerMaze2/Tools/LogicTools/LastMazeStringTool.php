<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class LastMazeStringTool implements ITool
{
    // union cell with different number sets and make wall between their
    public function getLastMazeString(array $mazeString, int $width): array
    {
        $prevMazeString = $mazeString;

        $mazeString = $this->removeLockCell($mazeString, $prevMazeString);

        for ($i = 1; $i < $width; $i++) {
            if ($mazeString[$i]['set'] !== $mazeString[$i - 1]['set']) {
                $mazeString[$i - 1]['rightWall'] = false;
                $mazeString[$i - 1]['set'] = $mazeString[$i]['set'];
            } else {
                $mazeString[$i - 1]['rightWall'] = true;
            }
        }

        // проверка на замкнутость
        foreach ($mazeString as $key => $mazeCell) {
            if ($mazeCell['rightWall'] === true && $mazeCell['topWall'] === true) {
                $mazeString[$key]['topWall'] = false;
            }
        }

        return $mazeString;
    }

    public function removeLockCell($mazeString, array $prevMazeString): array
    {
        // получение наборов с позициями ячеек в строке
        $sets = [];
        foreach ($mazeString as $key => $cell) {
            $sets[$cell['set']][] = $key;
        }

        foreach ($sets as $set) {
            foreach ($set as $key => $value) {
                if (count($set) === 1 && $prevMazeString[$value]['topWall'] === true) {
                    $mazeString[$value]['topWall'] = false;
                }
            }
        }

        return $mazeString;
    }

    public function makeMazeHarder(array $mazeString, array $prevMazeString): array
    {
        foreach ($mazeString as $key => $mazeCell) {
            if ($mazeCell['rightWall'] === false && $mazeCell['topWall'] === false) {
                //$mazeString[$key]['rightWall'] = true;
                // if ($mazeString[$key - 1]['rightWall'] === false) {
                // }
            }
        }

        return $mazeString;
    }
}
