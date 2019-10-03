<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\SessionTools;

use Avior\GameCore\Base\ITool;
use Modules\LidSystem\Entities\Lid;
use Modules\GameFrame\Entities\GameFrame;
use Modules\Games\Entities\V2Session;

class LidTool implements ITool
{
    public function saveGameResultForLid(
        int $lidId,
        bool $isWin,
        string $sessionUuid
    ): void {
        $isWin === true ? $gameResult = 'win' : $gameResult = 'lose';

        $session = V2Session::where('session_uuid', $sessionUuid)->first();

        $lid = Lid::find($lidId);
        $lid->game_result = $gameResult;
        $lid->session_id = $session->id;
        $lid->save();
    }
}
