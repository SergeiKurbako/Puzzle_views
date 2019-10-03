<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Data;

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
}
