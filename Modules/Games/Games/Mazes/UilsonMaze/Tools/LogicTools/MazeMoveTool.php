<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeMoveTool implements ITool
{
    /**
     * Проверка можно ли пройти столько клеток
     *
     * @param  int   $currentX [description]
     * @param  int   $currentY [description]
     * @param  int   $nextX    [description]
     * @param  int   $nextY    [description]
     *
     * @return array           [description]
     */
    public function checkMoveRange(
        int $currentX,
        int $currentY,
        int $nextX,
        int $nextY
    ): bool {
        $permittedMove = true;

        $resultCellX = abs($currentX - $nextX);
        $resultCellY = abs($currentY - $nextY);
        $deltaXY = $resultCellX + $resultCellY;
        if ($deltaXY !== 1) {
            $permittedMove = false;
        }

        return $permittedMove;
    }

    /**
     * Проверка не делается ли ход через стену
     *
     * @param  int  $currentX [description]
     * @param  int  $currentY [description]
     * @param  int  $nextX    [description]
     * @param  int  $nextY    [description]
     *
     * @return bool           [description]
     */
    public function checkMoveThroughWall(
        int $currentX,
        int $currentY,
        int $nextX,
        int $nextY,
        array $maze
    ): bool {
        $permittedMove = true;

        if ($nextX - $currentX === 1) { // ход вправо
            if ($maze[$currentY][$currentX]->rightWall === true) {
                $permittedMove = false;
            }
        }
        if ($currentX - $nextX === 1) { // ход влево
            if ($maze[$nextY][$nextX]->rightWall === true) {
                $permittedMove = false;
            }
        }
        if ($currentY - $nextY === 1) { // ход вверх (в лабирите)
            if ($maze[$nextY][$nextX]->bottomWall === true) {
                $permittedMove = false;
            }
        }
        if ($nextY - $currentY === 1) { // ход вниз (в лабирите)
            if ($maze[$currentY][$currentX]->bottomWall === true) {
                $permittedMove = false;
            }
        }

        return $permittedMove;
    }
}
