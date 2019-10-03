<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets;

use Avior\GameCore\RequestDataSets\RequestDataSet;

class SaveBotPositionRequestData extends RequestDataSet
{
    /** @var int позиция бота в массиве ячеек строки на которую перешел игрок */
    public $botCellX;

    /** @var int позиция бота в массиве строк массива на которую перешел игрок */
    public $botCellY;

    /** @var int номер бота */
    public $botNumber;
}
