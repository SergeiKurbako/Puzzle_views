<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerDownSpeedInstruction implements IInstruction
{
    public function downSpeed(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->speed -= $dataPool->requestData->downSpeed;
        $dataPool->stateData->action = 'down_speed';

        return $dataPool;
    }
}
