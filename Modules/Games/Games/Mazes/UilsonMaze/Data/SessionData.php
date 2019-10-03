<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Data;

use Avior\GameCore\Base\IData;

class SessionData implements IData
{
    /** @var int id пользователя в БД */
    public $userId = 0; // user_id должен равняться lid_id

    /** @var int id пользователя в БД */
    public $lidId = 0;

    /** @var int id игры в БД */
    public $gameId = 0;

    /** @var string мод игры */
    public $mode = '';

    /** @var string id пользовательской сессии в БД */
    public $sessionUuid = '';
}
