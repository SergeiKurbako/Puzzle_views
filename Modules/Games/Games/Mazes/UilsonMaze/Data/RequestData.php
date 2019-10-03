<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Data;

use Avior\GameCore\Base\IData;

/**
 * Класс описывает все данные которые могут быть получены из запроса
 */
class RequestData implements IData
{
    /** @var int id пользователя в БД */
    public $userId = 0;

    /** @var int id пользователя в БД */
    public $lidId = 0;

    /** @var int id игры в БД */
    public $gameId = 0;

    /** @var string мод игры */
    public $mode = '';

    /** @var string id пользовательской сессии в БД */
    public $sessionUuid = '';

    /** @var string действие которое хочет выполнить фронт */
    public $action = '';

    /** @var int позиция ячейки в массиве содержащего ячейки для строки лабиринта  */
    public $cellX = 0;

    /** @var int позиция ячейки в массиве строк лабиринта (отображение строк идет сверху вниз) */
    public $cellY = 0;

    /** @var int позиция ячейки в массиве ячеек строки на которую перешел игрок */
    public $needChunkX = 0;

    /** @var int позиция ячейки в массиве строк массива на которую перешел игрок */
    public $needChunkY = 0;

    /** @var int позиция бота в массиве ячеек строки на которую перешел игрок */
    public $botCellX = 0;

    /** @var int позиция бота в массиве строк массива на которую перешел игрок */
    public $botCellY = 0;

    /** @var int номер бота */
    public $botNumber = 0;
}
