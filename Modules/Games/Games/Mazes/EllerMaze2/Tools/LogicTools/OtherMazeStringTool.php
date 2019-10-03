<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class OtherMazeStringTool implements ITool
{
    public function getOtherMazeStringWithoutLastString(array $firstMazeString, int $height, int $width): array
    {
        $mazeStringArray = [];
        $mazeStringArray[] = $firstMazeString;


        for ($k = 1; $k < ($height - 1); $k++) {
            // if ($k === 50) {
            //     dd($mazeStringArray[$k - 1]);
            // }
            // make new maze string
            $mazeString = $mazeStringArray[$k - 1];

            // если ечейки пренадлежат одному множеству и при этом у них
            // нет верхней стены, то они заменяются новым множеством и имделается крыша.
            // Так делается для всех ячеек кроме одной
            $mazeString = $this->removeSameCell($mazeString, $k);

            // проверка наличия ячеек из разных множеств
            // при этом между которыми нет стенки
            $mazeString = $this->removeSameCellWithoutRightWall($mazeString, $mazeStringArray, $k);

            if ($k !== 1) {
                // объединяем ячейки
                $mazeString = $this->unionCells($mazeString, $k);
            }

            // создаются случайные вертикальные соединения
            $mazeString = $this->removeCellsFromSets($mazeString, $k);


            // удаляем из наборов ячейки у которых нет вертикального прохода
            // и заполняем их новыми значениями
            $mazeString = $this->fillingEmptyCells($mazeString, $k);

            // удаление верхних стен у ячеек, которые единственные в своем множестве
            $mazeString = $this->removeLockCell($mazeString, $mazeStringArray, $k);

            // дополнительное усложнение через создание потолков у ячеек, вокруг которых
            // есть ячейки с открытыми проходами
            $mazeString = $this->makeMazeHarder($mazeString, $mazeStringArray, $k, $height);

            $mazeStringArray[] = $mazeString;
        }

        return $mazeStringArray;
    }

    public function removeCellsFromSets(array $mazeString, int $k): array
    {
        // получение наборов с позициями ячеек в строке
        $sets = [];
        foreach ($mazeString as $key => $cell) {
            $sets[$cell['set']][] = $key;
        }

        // рандомная выборка ячеек в множествах, которые будут соеденены с верхними ячейками
        foreach ($sets as $set) {
            $countUsedCell = 0;

            foreach ($set as $key => $value) {
                if (count($set) === 1) {
                    $mazeString[$value]['topWall'] = false;
                    $countUsedCell += 1;
                } else {
                    if (rand(0, 1)) {
                        // раскоментировать для упращения
                        $mazeString[$value]['topWall'] = false;
                        $countUsedCell += 1;
                    } else {
                        //$mazeString[$value]['topWall'] = true;
                    }
                }
            }

            // проверка на наличие хотя бы одного вертикального прохода
            if ($countUsedCell === 0) {
                $mazeString[$value]['topWall'] = false;
            }
        }

        return $mazeString;
    }

    public function fillingEmptyCells(array $mazeString, int $k): array
    {
        // получение наборов с позициями ячеек в строке
        $max = 0;
        foreach ($mazeString as $key => $cell) {
            if ($cell['set'] > $max) {
                $max = $cell['set'];
            }
        }

        // присвоение новых множеств и правых стенок
        $count = count($mazeString);
        for ($i = 0; $i < $count; $i++) {
            if ($mazeString[$i]['topWall'] === true) {
                $max += 1;
                $mazeString[$i]['set'] = $max;
                $mazeString[$i]['rightWall'] = true;

                if ($i > 0) {
                    $mazeString[$i - 1]['rightWall'] = true;
                }
            }
        }

        return $mazeString;
    }

    public function unionCells(array $mazeString, int $k): array
    {
        $count = count($mazeString) - 1;
        for ($i = 0; $i < $count; $i++) {
            $rand = rand(0, 1);

            if ($rand === 0) {
                $mazeString[$i]['rightWall'] = false;
                $mazeString[$i + 1]['set'] = $mazeString[$i]['set'];
            }
        }

        return $mazeString;
    }

    public function removeLockCell($mazeString, array $mazeStringArray, int $k): array
    {
        // получение наборов с позициями ячеек в строке
        $sets = [];
        foreach ($mazeString as $key => $cell) {
            $sets[$cell['set']][] = $key;
        }

        foreach ($sets as $set) {
            foreach ($set as $key => $value) {
                if (count($set) === 1 && $mazeStringArray[$k - 1][$value]['topWall'] === true) {
                    $mazeString[$value]['topWall'] = false;
                }
            }
        }

        return $mazeString;
    }

    public function removeSameCell($mazeString, int $k): array
    {
        // получение наборов с позициями ячеек в строке
        $sets = [];
        $max = 0;
        foreach ($mazeString as $key => $cell) {
            $sets[$cell['set']][] = $key;

            if ($cell['set'] > $max) {
                $max = $cell['set'];
            }
        }

        foreach ($sets as $set) {
            foreach ($set as $key => $value) {
                if ($mazeString[$value]['topWall'] === false && $key !== (count($set) - 1)) {
                    $mazeString[$value]['set'] = $max + 1;
                    $mazeString[$value]['topWall'] = true;
                    $max += 1;
                }
            }
        }

        return $mazeString;
    }

    public function removeSameCellWithoutRightWall($mazeString, $mazeStringArray, $k): array
    {
        $count = count($mazeString) - 1;
        foreach ($mazeString as $key => $mazeCell) {
            if ($key < $count) {
                if ($mazeCell['set'] === $mazeString[$key + 1]['set']) {
                    $mazeCell['rightWall'] = true;
                    $mazeString[$key] = $mazeCell;
                }
            }
        }

        return $mazeString;
    }

    public function makeMazeHarder(array $mazeString, array $mazeStringArray, int $k, int $height): array
    {
        foreach ($mazeString as $key => $mazeCell) {
            if ($k === 1) {
                if ($mazeCell['topWall'] === false && $mazeCell['rightWall'] === true) {
                    if ($key !== 0 && $key > 2) {
                        if ($mazeStringArray[0][$key - 1]['rightWall'] === false) {
                            $mazeString[$key]['topWall'] = true;
                        }
                    }
                }
            }

            if ($key !== 0) {
                if ($mazeCell['rightWall'] === false && $mazeCell['topWall'] === false) {
                    if ($mazeString[$key - 1]['rightWall'] === false && $mazeString[$key - 1]['topWall'] === false) {
                        if ($mazeStringArray[$k - 1][$key - 1]['rightWall'] === false) {
                            $mazeString[$key - 1]['rightWall'] = true;
                        }
                    }
                }
                if ($mazeCell['rightWall'] === true && $mazeCell['topWall'] === false) {
                    if ($mazeString[$key - 1]['rightWall'] === false && $mazeString[$key - 1]['topWall'] === false) {
                        if ($mazeStringArray[$k - 1][$key - 1]['rightWall'] === false) {
                            $mazeString[$key - 1]['topWall'] = true;
                        }
                    }
                    if ($mazeString[$key - 1]['rightWall'] === true && $mazeString[$key - 1]['topWall'] === false) {
                        if ($mazeStringArray[$k - 1][$key - 1]['rightWall'] === false) {
                            $mazeString[$key - 1]['rightWall'] = true;
                        }
                    }
                }
                if ($mazeCell['rightWall'] === true && $mazeString[$key - 1]['rightWall'] === true) {
                    $mazeString[$key - 1]['rightWall'] = true;
                }

                $count = count($mazeString) - 1;
                if ($key === $count) {
                    if ($mazeCell['topWall'] === false) {
                        if ($mazeStringArray[$k - 1][$key - 1]['rightWall'] === false) {
                            if ($mazeString[$key - 1]['topWall'] === false && $mazeStringArray[$k - 1][$key]['topWall'] === false) {
                                $mazeString[$key]['topWall'] = true;
                            }
                        }
                    }
                }

            }
        }

        return $mazeString;
    }
}
