<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets;

use Avior\GameCore\RequestDataSets\RequestDataSet;

class MoveRequestData extends RequestDataSet
{
    /** @var int позиция ячейки в массиве ячеек строки на которую перешел игрок */
    public $cellX;

    /** @var int позиция ячейки в массиве строк массива на которую перешел игрок */
    public $cellY;
}
