<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerDownTimeInstruction implements IInstruction
{
    public function downTime(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->time -= $dataPool->requestData->downTime;
        $dataPool->stateData->action = 'down_time';

        return $dataPool;
    }
}
