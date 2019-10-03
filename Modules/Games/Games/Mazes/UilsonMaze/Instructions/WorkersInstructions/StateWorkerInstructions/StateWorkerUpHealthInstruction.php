<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

class StateWorkerUpHealthInstruction implements IInstruction
{
    public function upHealth(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->action = 'up_health';

        // проверка наличия бонуса на клетке
        $check = $toolsPool->logicTools->mazeBonusTool->checkHealthBonusOnCell(
            $dataPool->logicData->maze,
            $dataPool->stateData->cellX,
            $dataPool->stateData->cellY
        );

        if ($check === true) {
            // проверка на полученное кол-во бонусов
            if ($dataPool->stateData->healthBonusReceived < $dataPool->logicData->countOfHealthBonus) {
                $dataPool->stateData->healthBonusReceived += 1;
                $dataPool->stateData->health += $dataPool->logicData->healthBonusValue;
                $dataPool->logicData->maze[$dataPool->stateData->cellY][$dataPool->stateData->cellX]->healthBonus = false;
            }
        }

        return $dataPool;
    }
}
