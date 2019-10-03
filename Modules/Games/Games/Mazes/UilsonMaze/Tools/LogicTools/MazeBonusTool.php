<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeBonusTool implements ITool
{
    public function addBonuses(
        array $maze,
        int $countOfSpeedBonus,
        int $countOfHealthBonus
    ): array {
        $yCount = count($maze);
        $xCount = count($maze[0]);

        // создание набора всех номеров ячеек для последующего рандома
        $cells = [];
        $count = 0;
        for ($i = 0; $i < $yCount; $i++) {
            for ($k = 0; $k < $xCount; $k++) {
                $count += 1;
                $cells[] = $count;
            }
        }

        //$countOfBonuses = count($maze) * count($maze[0]);
        $usedCells = array_rand($cells, ($countOfSpeedBonus + $countOfHealthBonus));

        shuffle($usedCells);

        // добавление в лабиринт бонусов скорости
        for ($i = 0; $i < $countOfSpeedBonus; $i++) {
            $randNumber = $usedCells[$i];

            $x = $randNumber % $xCount;
            $y = ($randNumber - $x) / $xCount;

            $maze[$y][$x]['speedBonus'] = true;

            unset($usedCells[$i]);
        }

        // добавление в массив бонусов жизней
        foreach ($usedCells as $key => $value) {
            $randNumber = $usedCells[$key];

            $x = $randNumber % $xCount;
            $y = ($randNumber - $x) / $xCount;

            $maze[$y][$x]['healthBonus'] = true;

            unset($usedCells[$key]);
        }

        return $maze;
    }

    public function checkSpeedBonusOnCell(array $maze, int $cellX, int $cellY): bool
    {
        $check = true;

        if ($maze[$cellY][$cellX]->speedBonus === false) {
            $check = false;
        }

        return $check;
    }

    public function checkHealthBonusOnCell(array $maze, int $cellX, int $cellY): bool
    {
        $check = true;

        if ($maze[$cellY][$cellX]->healthBonus === false) {
            $check = false;
        }

        return $check;
    }

    public function checkTimeBonusOnCell(array $maze, int $cellX, int $cellY): bool
    {
        $check = true;

        if ($maze[$cellY][$cellX]->timeBonus === false) {
            $check = false;
        }

        return $check;
    }
}
