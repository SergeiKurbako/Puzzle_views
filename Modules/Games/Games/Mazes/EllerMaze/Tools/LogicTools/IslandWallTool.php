<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class IslandWallTool implements ITool
{
    public function unionBottomWallWithTopWall(array $maze): array
    {
        // $maze =\unserialize('a:4:{i:0;a:5:{i:0;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:1;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:2;a:3:{s:9:"numberSet";i:2;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:3;a:3:{s:9:"numberSet";i:2;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:4;a:3:{s:9:"numberSet";i:4;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}}i:1;a:5:{i:0;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:1;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:2;a:3:{s:9:"numberSet";i:2;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:3;a:3:{s:9:"numberSet";i:6;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:4;a:3:{s:9:"numberSet";i:6;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}}i:2;a:5:{i:0;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:1;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:2;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:3;a:3:{s:9:"numberSet";i:6;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:4;a:3:{s:9:"numberSet";i:6;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}}i:3;a:5:{i:0;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:1;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:2;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:3;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:4;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}}}');
        //
        // $numberOfLastMazeString = count($maze) - 1;
        // foreach ($maze[$numberOfLastMazeString] as $cellKey => $value) {
        //     // если у нижней ячейки есть правая стенка
        //     if ($maze[$numberOfLastMazeString][$cellKey]['rightWall'] === true) {
        //     }
        //
        //     // если нет у нижней грани правой ячейки
        //     if ($maze[$numberOfLastMazeString][$cellKey]['rightWall'] === false) {
        //         // проверка есть ли поставить правую грань, то будет ли создано
        //         // замыкание с краем лабиринта
        //
        //         $modifiedMaze = $maze;
        //         $modifiedMaze[$cellKey]['rightWall'] = true;
        //
        //         $check = $this->checkLastCellOnRightWall($modifiedMaze, $cellKey, $numberOfLastMazeString, 0);
        //
        //         if ($check === true) {
        //             $maze = $modifiedMaze;
        //         }
        //     }
        // }

        //dd($maze);

        return $maze;
    }

    /**
     * Получение наиболее отдаленной ячейки, которая может быть
     *
     * @param  array $maze                   [description]
     * @param  int   $cellKey                [description]
     * @param  int   $numberOfLastMazeString [description]
     *
     * @return array                         [description]
     */
    protected function checkLastCellOnRightWall(
        array $maze,
        int $cellKey,
        int $numberOfLastMazeString,
        int $step
    ): array {
        // проврка является ли ячейка краем лабиринта

        if ($checkEdge === false)
        if ($maze) {
            $checkEdge = false;
            if ($cellKey === 0) {
                $checkEdge = true;
            }
            if ($cellKey === (count($maze[0]) - 1)) {
                $checkEdge = true;
            }
            if ($numberOfLastMazeString === 0) {
                $checkEdge = true;
            }
            if ($numberOfLastMazeString === (count($maze) - 1)) {
                $checkEdge = true;
            }
        }

        // проверка наличия пола у верхней ячеки
        if ($maze[$numberOfLastMazeString - 1][$cellKey]['bottomWall'] === true) {
            $check1 = $this->checkLastCellOnBottomWall($maze, $cellKey, $numberOfLastMazeString - 1);
        }

        // проверка наличия правой стенки у верхней ячеки
        if ($maze[$numberOfLastMazeString - 1][$cellKey]['bottomWall'] === true) {
            $check1 = $this->checkLastCell($maze, $cellKey, $numberOfLastMazeString - 1);
        }

        // проверка наличия пола у верхней ячеки которая левее
        if ($maze[$numberOfLastMazeString - 1][$cellKey + 1]['bottomWall'] === true) {
            $check1 = $this->checkLastCellOnBottomWall($maze, $cellKey + 1, $numberOfLastMazeString - 1);
        }

        $check = $this->isEdgeCell($lastCell);

        return $nextCell;
    }

    protected function isEdgeCell(
        int $lastCell
    ): bool {
        if ($lastCell['cellStringNumber']) {
            return true;
        }

        return $maze;
    }
}
