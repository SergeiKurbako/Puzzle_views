<?php

namespace Modules\Games\Repositories;

use Modules\Games\Entities\V2RecoveryData;

/**
 *
 */
class RecoveryDataRepository
{
    public static function getAllUserMoves(string $sessionUuid)
    {
        $allMoves = V2RecoveryData::where('session_id')->get();

        return $allMoves;
    }
}
