<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerUpSpeedInstruction implements IInstruction
{
    public function upSpeed(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->action = 'up_speed';

        // проверка наличия бонуса на клетке
        $check = $toolsPool->logicTools->mazeBonusTool->checkSpeedBonusOnCell(
            $dataPool->logicData->maze,
            $dataPool->stateData->cellX,
            $dataPool->stateData->cellY
        );

        if ($check === true) {
            if ($dataPool->stateData->speedBonusReceived < $dataPool->logicData->countOfSpeedBonus) {
                $dataPool->stateData->speedBonusReceived += 1;
                $dataPool->stateData->speed += $dataPool->logicData->speedBonusValue;
                $dataPool->logicData->maze[$dataPool->stateData->cellY][$dataPool->stateData->cellX]->speedBonus = false;
            }
        }

        return $dataPool;
    }
}
