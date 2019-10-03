<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerDownHealthInstruction implements IInstruction
{
    public function downHealth(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->health -= $dataPool->requestData->downHealth;
        $dataPool->stateData->action = 'down_health';

        return $dataPool;
    }
}
