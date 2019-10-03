<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets;

use Avior\GameCore\RequestDataSets\RequestDataSet;

class GetChunkRequestData extends RequestDataSet
{
    /** @var int позиция ячейки в массиве ячеек строки относительно которой нужно получить чанк */
    public $needChunkX;

    /** @var int позиция ячейки в массиве строк массива  относительно которой нужно получить чанк */
    public $needChunkY;
}
