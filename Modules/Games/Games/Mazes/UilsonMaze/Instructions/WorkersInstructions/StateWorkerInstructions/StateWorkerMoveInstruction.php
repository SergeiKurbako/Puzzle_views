<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerMoveInstruction implements IInstruction
{
    public function setPermittedMove(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->permittedMove = true;
        $dataPool->stateData->action = 'move';
        $dataPool->stateData->currentMicroTime = microtime(true);

        return $dataPool;
    }

    public function checkMoveRange(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->permittedMove = $toolsPool->logicTools->mazeMoveTool->checkMoveRange(
            $dataPool->stateData->cellX,
            $dataPool->stateData->cellY,
            $dataPool->requestData->cellX,
            $dataPool->requestData->cellY
        );

        return $dataPool;
    }

    public function checkMoveThroughWall(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        if ($dataPool->stateData->permittedMove === true) {
            $dataPool->stateData->permittedMove = $toolsPool->logicTools->mazeMoveTool->checkMoveThroughWall(
                $dataPool->stateData->cellX,
                $dataPool->stateData->cellY,
                $dataPool->requestData->cellX,
                $dataPool->requestData->cellY,
                $dataPool->logicData->maze
            );
        }

        return $dataPool;
    }

    public function move(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        if ($dataPool->stateData->permittedMove === true) {
            $dataPool->stateData->action = $dataPool->requestData->action;
            $dataPool->stateData->cellX = $dataPool->requestData->cellX;
            $dataPool->stateData->cellY = $dataPool->requestData->cellY;
            $dataPool->stateData->moveCount += 1;
            $dataPool->stateData->permittedMove = true;
        }

        return $dataPool;
    }
}
