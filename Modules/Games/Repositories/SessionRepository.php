<?php

namespace Modules\Games\Repositories;

use Modules\Games\Entities\V2Session;

/**
 *
 */
class SessionRepository
{
    public static function getAllReciveryData(string $sessionUuid)
    {
        $allMoves = V2Session::where('session_uuid', $sessionUuid)->first()->recoveryData;

        return $allMoves;
    }
}
