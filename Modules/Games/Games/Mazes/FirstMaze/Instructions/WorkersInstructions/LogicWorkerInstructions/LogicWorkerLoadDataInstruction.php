<?php

namespace Modules\Games\Games\Mazes\FirstMaze\Instructions\WorkersInstructions\LogicWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

/**
 * Класс содержащий набор методов, которые последовательно выполняются в воркером
 * Загрузка данных связанных с логикой игры.
 * Делается только при старте игры. Данные генерируются в независимости от
 * восстановления сессии
 */
class LogicWorkerLoadDataInstruction implements IInstruction
{
    public function loadRequestData(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->logicData->mazeWidth = $dataPool->requestData->mazeWidth;
        $dataPool->logicData->mazeHeight = $dataPool->requestData->mazeHeight;

        return $dataPool;
    }

    /**
     * Генерация лабиринта
     *
     * @param  IDataPool  $dataPool  [description]
     * @param  IToolsPool $toolsPool [description]
     *
     * @return IDataPool             [description]
     */
    public function mazeGeneration(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $startWidth = $dataPool->logicData->mazeWidth;
        $startHeight = $dataPool->logicData->mazeHeight;
        $width = $startWidth;
        $height = $startHeight;

        // создать двумерный массив
        $maze = []; // лабиринт
        for ($i = 0; $i < $height; $i++) {
            for ($j = 0; $j < $width; $j++) {
                if(
                    ($i % 2 != 0  && $j % 2 != 0) &&  // если ячейка нечетная по x и y,
                    ($i < ($height-1) && $j < ($width-1)) // и при этом находится в пределах стен лабиринта
                ) {
                    $maze[$i][$j] = 'EMPTY';
                } else {
                    $maze[$i][$j] = 'WALL';
                }

                if ($i === 1 && $j === 1) {
                    $maze[$i][$j] = 'EMPTY';
                }
            }
        }

        // копия лабиринта для отслеживания обработанных пустых ячеек
        $cellVisits = $maze;

        // перемещаемся из начальной точки к соседу
        $startCell = [1,1]; // [ширина, высота]
        $cellVisits[1][1] = 'VISITED';

        $stackOfIterations = [];
        $iteraionCounter = 0;
        do {
            // получение координат соседей
            $neighbors = [];

            // если отсутствуют соседи, то делается перемещение стартовой ячейкт
            // назад по стеку
            while ($neighbors === []) {
                // добавление стартовой ячейки в стек
                $stackOfIterations[] = $startCell;

                // проверка наличия правого соседа
                if ($startCell === []) {
                    break;
                }
                $neighbor = [$startCell[0], $startCell[1] + 2];
                if (isset($maze[$neighbor[0]][$neighbor[1]])) {
                    // проверка является ли сосед коридором
                    if ($maze[$neighbor[0]][$neighbor[1]] === 'EMPTY') {
                        if ($cellVisits[$neighbor[0]][$neighbor[1]] !== 'VISITED') {
                            $neighbors[] = $neighbor;
                        }
                    }
                }

                // проверка наличия левого соседа
                $neighbor = [$startCell[0], $startCell[1] - 2];
                if (isset($maze[$neighbor[0]][$neighbor[1]])) {
                    // проверка является ли сосед коридором
                    if ($maze[$neighbor[0]][$neighbor[1]] === 'EMPTY') {
                        if ($cellVisits[$neighbor[0]][$neighbor[1]] !== 'VISITED') {
                            $neighbors[] = $neighbor;
                        }
                    }
                }

                // проверка наличия верхнего соседа
                $neighbor = [$startCell[0] + 2, $startCell[1]];
                if (isset($maze[$neighbor[0]][$neighbor[1]])) {
                    // проверка является ли сосед коридором
                    if ($maze[$neighbor[0]][$neighbor[1]] === 'EMPTY') {
                        if ($cellVisits[$neighbor[0]][$neighbor[1]] !== 'VISITED') {
                            $neighbors[] = $neighbor;
                        }
                    }
                }

                // проверка наличия нижнего соседа
                $neighbor = [$startCell[0] - 2, $startCell[1]];
                if (isset($maze[$neighbor[0]][$neighbor[1]])) {
                    // проверка является ли сосед коридором
                    if ($maze[$neighbor[0]][$neighbor[1]] === 'EMPTY') {
                        if ($cellVisits[$neighbor[0]][$neighbor[1]] !== 'VISITED') {
                            $neighbors[] = $neighbor;
                        }
                    }
                }

                // при отсутсвии непосещенных соседей делается возврат по стеку
                if ($neighbors === []) {
                    // получение координат предыдущей стартовой точки
                    unset($stackOfIterations[count($stackOfIterations) - 1]);
                    if (isset($stackOfIterations[count($stackOfIterations) - 1])) {
                        $startCell = $stackOfIterations[count($stackOfIterations) - 1];
                        $stackOfIterations[] = $startCell;
                    } else {
                        // в маршруте больше нет точки у которой есть не посещенные сосед
                        // перемещаемся к случайной непосещенной точке, у которой есть посещенный сесед
                        $startCell = [];
                        foreach ($cellVisits as $height => $widths) {
                            foreach ($widths as $width => $value) {
                                if ($value === 'VISITED') {
                                    $neighbor1 = [$height, $width + 2];
                                    $neighbor2 = [$height, $width - 2];
                                    $neighbor3 = [$height - 2, $width];
                                    $neighbor4 = [$height + 2, $width];

                                    $neighbors = [$neighbor1, $neighbor2, $neighbor3, $neighbor4];

                                    shuffle($neighbors);

                                    foreach ($neighbors as $neighbor) {
                                        if (isset($cellVisits[$neighbor[0]][$neighbor[1]])) {
                                            if ($cellVisits[$neighbor[0]][$neighbor[1]] === "EMPTY") {
                                                $startCell = [$height, $width];
                                                break(3);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($startCell !== []) {
                // если нет больше соседий, то лабиринт построен
                if ($neighbors === []) {
                    break;
                }


                // выбор рандомного соседа
                $randNeighbor = $neighbors[rand(0, count($neighbors) - 1)];

                // получение координаты стены которую нужно сделать коридором
                // для соединения двух точек
                $connectingCell[0] = $startCell[0] + ($randNeighbor[0] - $startCell[0]) / 2;
                $connectingCell[1] = $startCell[1] + ($randNeighbor[1] - $startCell[1]) / 2;

                // применение значения EMPTY к соединительной ячейке
                $maze[$connectingCell[0]][$connectingCell[1]] = 'EMPTY';

                // выбранный сосед становится стартовой ячейкой для следующей итерации
                $startCell = $randNeighbor;

                // делаются отметки для посещенных ячеек
                $cellVisits[$randNeighbor[0]][$randNeighbor[1]] = 'VISITED';
            }

        } while ($neighbors !== []);

        if ($height === -1) {
            return $this->mazeGeneration($dataPool, $toolsPool);
        }

        // очистка 0h ряда
        foreach ($maze[0] as $width => $value) {
            $maze[0][$width] = 'WALL';
        }

        // очистка last h ряда
        foreach ($maze[$height] as $width => $value) {
            $maze[$height][$width] = 'WALL';
        }

        // очистка 0w ряда
        for ($i=0; $i < $height; $i++) {
            $maze[$i][0] = 'WALL';
        }

        // очистка last w ряда
        for ($i=0; $i < $height; $i++) {
            $maze[$i][$width] = 'WALL';
        }

        // вход и выход из лабиринта
        $maze[0][1] = 'EMPTY';
        $maze[$startHeight-1][$startWidth-2] = 'EMPTY';

        // отображение
        // foreach ($maze as $height => $widths) {
        //     foreach ($widths as $width => $value) {
        //         if ($value === 'WALL') {
        //             echo '0';
        //         } else {
        //             echo '7';
        //         }
        //     }
        //     echo '<br>';
        // }
        //
        // dd($maze);

        $jsonMaze = json_encode($maze);
        // замена всех WALL на 0
        $jsonMaze = str_replace('WALL', 0, $jsonMaze);

        // замена всех EMPTY на 1
        $jsonMaze = str_replace('EMPTY', 1, $jsonMaze);

        $maze = json_decode($jsonMaze);

        $dataPool->logicData->maze = $maze;

        return $dataPool;
    }


}
