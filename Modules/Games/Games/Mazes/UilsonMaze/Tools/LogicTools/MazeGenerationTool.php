<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeGenerationTool implements ITool
{
    public function generation(int $width, int $height): array
    {
        $maze = []; // лабиринт
        $notUsedCells = []; // перечень ячеек которые не были использованы

        // создать двумерный массив
        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                $maze[$i][$j] = [
                    'rightWall' => true,
                    'bottomWall' => true,
                    'cellX' => $j,
                    'cellY' => $i,
                    'healthBonus' => false,
                    'speedBonus' => false,
                    'timeBonus' => false
                ];

                // добавление ключа не использованной ячейки
                $notUsedCells[] = $i * $width + $j;
            }

        }

        // создаем первую ячейку дерева
        unset($notUsedCells[0]);

        while (count($notUsedCells) > 0) {
            // генера пути
            $cellPathData = $this->makeCellPath($notUsedCells, $width, $height);

            if ($cellPathData['cellPath'] !== []) {
                // добавление путь в дерево
                $maze = $this->addCellPathToMaze($maze, $cellPathData['cellPath'], $width, $height);

                // убираем из $notUsedCells использованные номера ячеек
                $notUsedCells = $this->addUsedCells($notUsedCells, $cellPathData['cellPath']);
            }
        }

        return $maze;
    }

    /**
     * Функиця возвращает массив с информацией о попытке построении коридора
     * @param  array $notUsedCells [description]
     * @param  int   $width        [description]
     * @param  int   $height       [description]
     * @return array               ['success' => bool, 'cellPath' => []]
     */
    protected function makeCellPath(array $notUsedCells, int $width, int $height): array
    {
        $cellPathData = ['success' => true, 'cellPath' => [], 'notUsedCells' => $notUsedCells];

        // создаем новую версию перечня не посещенных ячеек
        $newNotUsedCells = $notUsedCells;

        // выбираем рандомную ячейку из списка не посещенных
        $cellNumber = array_rand($notUsedCells);
        $cellPath[] = $cellNumber; // добавляем ячейку в путь
        unset($newNotUsedCells[$cellNumber]); // удаляем ячейку из списка

        //$status = 'addCell'; // провекра получения законченого пути 'addCell', 'complete', false

        $nextCellNumber = $cellNumber;
        $prevDirection = '';
        $status = true;
        while ($status !== 'complete') {
            $nextCellData = $this->getNextRandomCell($nextCellNumber, $prevDirection, $width, $height);
            $nextCellNumber = $nextCellData['nextCellNumber'];

            if ($nextCellData['success'] === false) {
                $status = false;
            }

            $nextCellNumber = $nextCellData['nextCellNumber'];

            // получение координат новой ячейки в лабиринте
            $x = $nextCellNumber % $width;
            $y = ($nextCellNumber - $x) / $width;

            // проверка существует ли новая ячейка
            if ($x >= $width) {
                $status = false;
            }
            if ($x < 0) {
                $status = false;
            }
            if ($y >= $height) {
                $status = false;
            }
            if ($y < 0) {
                $status = false;
            }

            // проверка не была ли она уже добавлена в текущий путь
            if (in_array($nextCellNumber, $cellPath)) {
                $status = false;
            }

            if ($status === false) {
                $cellPath = [];

                // создаем новую версию перечня не посещенных ячеек
                $newNotUsedCells = $notUsedCells;
                break;
            }

            if ($status !== false) {
                // проверка является ли данная ячейка частью построенного дерева
                if (!in_array($nextCellNumber, $notUsedCells)) {
                    $cellPath[] = $nextCellNumber;
                    $cellPathData['notUsedCells'] = $newNotUsedCells;
                    $cellPathData['cellPath'] = $cellPath;
                    $cellPathData['success'] = true;
                    $status = 'complete';
                } else {
                    unset($newNotUsedCells[$nextCellNumber]); // удаляем ячейку из списка
                    $prevDirection = $nextCellData['direction'];
                    $cellPath[] = $nextCellNumber;
                }
            }
        }

        return $cellPathData;
    }

    protected function getNextRandomCell(
        int $cellNumber,
        string $prevDirection,
        int $width,
        int $height
    ): array {
        $data = ['success' => true, 'nextCellNumber' => 0, 'direction' => ''];

        // массив с кодами направлений
        $array = [0, 1, 2, 3];

        if ($prevDirection !== '') {
            if ($prevDirection === 'right') {
                $array = [0, 2, 3];
            }
            if ($prevDirection === 'left') {
                $array = [1, 2, 3];
            }
            if ($prevDirection === 'top') {
                $array = [0, 1, 2];
            }
            if ($prevDirection === 'bottom') {
                $array = [0, 1, 3];
            }
        }

        // получение координаты ячейки в лабиринте
        $x = $cellNumber % $width;
        $y = ($cellNumber - $x) / $width;

        // удаление напрвления, которое ведет за стену
        if ($x + 1 >= $width) {
            foreach ($array as $key => $value) {
                if ($value === 0) {
                    unset($array[$key]);
                    break;
                }
            }
        }
        if ($x - 1 < 0) {
            foreach ($array as $key => $value) {
                if ($value === 1) {
                    unset($array[$key]);
                    break;
                }
            }
        }
        if (($y + 1) >= ($height - 1)) {
            foreach ($array as $key => $value) {
                if ($value === 3) {
                    unset($array[$key]);
                    break;
                }
            }
        }
        if ($y - 1 < 0) {
            foreach ($array as $key => $value) {
                if ($value === 2) {
                    unset($array[$key]);
                    break;
                }
            }
        }

        $rand = array_rand($array);
        switch ($array[$rand]) {
            case 0:
                // получение номера ячейки справа
                $newX = $x + 1;
                $newY = $y;
                $data['direction'] = 'right';
                //echo 'right; x: ' . $newX . ' y: ' . $newY . '<br>';
                break;

            case 1:
                // получение номера ячейки слева
                $newX = $x - 1;
                $newY = $y;
                $data['direction'] = 'left';
                //echo 'left; x: ' . $newX . ' y: ' . $newY . '<br>';
                break;

            case 2:
                // получение номера ячейки вверху
                $newX = $x;
                $newY = $y - 1;
                $data['direction'] = 'top';
                //echo 'top; x: ' . $newX . ' y: ' . $newY . '<br>';
                break;

            case 3:
                // получение номера ячейки внизу
                $newX = $x;
                $newY = $y + 1;
                $data['direction'] = 'bottom';
                //echo 'bottom; x: ' . $newX . ' y: ' . $newY . '<br>';
                break;

            default:
                $data['success'] = false;
                break;
        }

        // if ($prevDirection === 'left' && $data['direction'] === 'right') {
        //     dd(__METHOD__, $prevDirection, $data['direction'], $array);
        // }

        $data['nextCellNumber'] = $newY * $width + $newX;

        // if (($data['nextCellNumber'] - ($y * $width + $x)) > 5 || (($y * $width + $x) - $data['nextCellNumber']) > 5) {
        //     dd(__METHOD__, $prevDirection, $data['direction'], $array);
        // }

        return $data;
    }

    protected function addCellPathToMaze(array $maze, array $cellPath, int $width, int $height): array
    {
        $prevX = $cellPath[0] % $width;
        $prevY = ($cellPath[0] - $prevX) / $width;

        foreach ($cellPath as $key => $cellNumber) {
            if ($key !== 0) {
                // получение координаты ячейки в лабиринте
                $x = $cellNumber % $width;
                $y = ($cellNumber - $x) / $width;

                if ($x - $prevX === 1) {
                    $direction = 'right';
                    $maze[$prevY][$prevX]['rightWall'] = false;
                }
                if ($x - $prevX === -1) {
                    $direction = 'left';
                    $maze[$y][$x]['rightWall'] = false;
                }
                if ($y - $prevY === 1) {
                    $direction = 'bottom';
                    $maze[$prevY][$prevX]['bottomWall'] = false;
                }
                if ($y - $prevY === -1) {
                    $direction = 'top';
                    $maze[$y][$x]['bottomWall'] = false;
                }
                $prevX = $x;
                $prevY = $y;
            }
        }

        return $maze;
    }

    protected function addUsedCells(array $notUsedCells, array $cellPath): array
    {
        foreach ($cellPath as $key => $cellNumber) {
            unset($notUsedCells[$cellNumber]);
        }

        return $notUsedCells;
    }
}
