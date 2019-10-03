<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Data;

use Avior\GameCore\Base\IData;

/**
 * Класс данных описывающий состояние игры полученное в результате действия
 */
class StateData implements IData
{
    /** @var string на каком экране находится игрок (mainGame, featureGame, jackpot, doubleGame ...) */
    public $screen = '';

    /** @var string текущее действие */
    public $action = '';

    /** @var int позиция ячейки пользователя в массиве содержащего ячейки для строки лабиринта  */
    public $cellX = 0;

    /** @var int позиция ячейки пользователя в массиве строк лабиринта (отображение строк идет сверху вниз) */
    public $cellY = 0;

    /** @var int кол-во ходов сделанное пользователем */
    public $moveCount = 0;

    /** @var bool возможность выполения переданного перемещения игрока */
    public $permittedMove = true;

    /** @var bool выигрышь в игре */
    public $isWin = false;

    /** @var int текущее кол-во жизней */
    public $health = 3;

    /** @var int доступное время для игры */
    public $time = 60;

    /** @var int текущая скорость передвижения */
    public $speed = 500;

    /** @var int текущая скорость передвижения */
    public $botSpeed = 64;

    /** @var int кол-во полученных бонусов */
    public $speedBonusReceived = 0;

    /** @var int кол-во полученных бонусов */
    public $healthBonusReceived = 0;

    /** @var int кол-во полученных бонусов */
    public $timeBonusReceived = 0;

    /** @var int время начала игры */
    public $startUnixTime = 0;

    /** @var int время окончания игры */
    public $endUnixTime = 0;

    /** @var int текущее время для данного состояния */
    public $currentMicroTime = 0;

    /** @var array массив содержащий данные о перемещении ботов [[botNumber, x, y, microtime], ...] */
    public $botPositions = [];
}
