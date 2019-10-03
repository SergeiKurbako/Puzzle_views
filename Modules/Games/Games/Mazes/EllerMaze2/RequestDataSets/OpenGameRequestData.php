<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\RequestDataSets;

use Avior\GameCore\Base\IRequestDataSet;

class OpenGameRequestData implements IRequestDataSet
{
    /** @var string выполняемое действие */
    public $action;

    /** @var int ширина лабиринта */
    public $mazeWidth;

    /** @var int высота лабиринта */
    public $mazeHeight;
}
