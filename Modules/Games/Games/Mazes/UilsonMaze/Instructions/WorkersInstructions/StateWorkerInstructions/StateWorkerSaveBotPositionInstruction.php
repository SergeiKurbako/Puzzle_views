<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerSaveBotPositionInstruction implements IInstruction
{
    public function saveBotPosition(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->botPositions[] = [
            $dataPool->requestData->botNumber,
            $dataPool->requestData->botCellX,
            $dataPool->requestData->botCellY,
            microtime(true)
        ];

        return $dataPool;
    }

}
