<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\RequestDataSets;

use Avior\GameCore\RequestDataSets\RequestDataSet;

class OpenGameRequestData extends RequestDataSet
{
    /** @var int id пользователя в БД в lids */
    public $lidId;

    /** @var int id пользователя в БД в lids */
    public $userId;
}
