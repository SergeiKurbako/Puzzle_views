<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Data;

use Avior\GameCore\Base\IData;

/**
 * Класс содержит все данные, которые связаны с игровой логикой
 */
class LogicData implements IData
{
    /** @var int ширина лабиринта */
    public $mazeWidth;

    /** @var int высота лабиринта */
    public $mazeHeight;

    /** @var string лабиринт [[,,,],[,,,] ... ] */
    public $maze;

    /** @var int размер чанков по горизонтали и вертикали, которые передаются
    * на фронт для порционной отрисовки. Размер должне быть четным.
    */
    public $chunkSize = 10;

    /** @var int кол-во клеток по ширине, которое видит пользователь */
    public $cameraWidth = 10;

    /** @var int кол-во клеток по высоте, которое видит пользователь */
    public $cameraHeight = 10;

    /** @var int Дальность до клетки от текущей, для которой можно запросить чанк */
    public $rangeOfChunkReceiving = 5;

    /** @var int ключ начальной ячейки в массиве содержащем данные ячеек строки массива */
    public $startCellX = 1;

    /** @var int ключ начальной строки в массиве содержащем строки лабиринта */
    public $startCellY = 1;

    /** @var int ключ конечной ячейки в массиве описывающем строку */
    public $endCellX = 1;

    /** @var int ключ конечной строки в массиве содержащем строки */
    public $endCellY = 1;

    /** @var array массив который содержит описание ячеек участка лабиринта
    * и координаты точки вокруг которой они находятся ['centerX' => , 'centerY' => , 'cells' => [данные_ячеек]]
    */
    public $chunk = ['centerX' => 0, 'centerY' => 0, 'cells' => []];

    /** @var int максимальное кол-во жизней */
    public $maxHealth = 3;

    /** @var int минимальное кол-во жизней */
    public $minHealth = 0;

    /** @var int минимальная скорость движения */
    public $minSpeed = 0;

    /** @var int максимальная скорость движения */
    public $maxSpeed = 500;

    /** @var int максимальное кол-во бонусов скорости */
    public $countOfSpeedBonus = 5;

    /** @var int максимальное кол-во бонусов жизней */
    public $countOfHealthBonus = 5;

    /** @var int максимальное кол-во бонусов времени */
    public $countOfTimeBonus = 5;

    /** @var int скорость уменьшения доступного времени в относительных единицах */
    public $decreaseTime = 10;

    /** @var int величина бонуса */
    public $speedBonusValue = 100;

    /** @var int величина бонуса */
    public $healthBonusValue = 1;

    /** @var int величина бонуса в секундах */
    public $timeBonusValue = 10;

}
