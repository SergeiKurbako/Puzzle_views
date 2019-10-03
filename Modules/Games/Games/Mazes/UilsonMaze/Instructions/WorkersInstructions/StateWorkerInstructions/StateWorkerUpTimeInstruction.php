<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerUpTimeInstruction implements IInstruction
{
    public function upTime(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->action = 'up_time';

        // проверка наличия бонуса на клетке
        $check = $toolsPool->logicTools->mazeBonusTool->checkTimeBonusOnCell(
            $dataPool->logicData->maze,
            $dataPool->stateData->cellX,
            $dataPool->stateData->cellY
        );

        if ($check === true) {
            if ($dataPool->stateData->timeBonusReceived < $dataPool->logicData->countOfTimeBonus) {
                $dataPool->stateData->timeBonusReceived += 1;
                $dataPool->stateData->time += $dataPool->logicData->timeBonusValue;
                $dataPool->logicData->maze[$dataPool->stateData->cellY][$dataPool->stateData->cellX]->timeBonus = false;
            }
        }

        return $dataPool;
    }
}
