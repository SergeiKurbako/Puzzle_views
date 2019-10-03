<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

/**
 * Класс содержащий набор методов, которые последовательно выполняются в воркером
 * Загрузка данных исходного состояния
 */
class StateWorkerLoadDataInstruction implements IInstruction
{
    /**
     * Загрузка данных исходного состояния
     *
     * @param IDataPool $dataPool
     * @param IToolsPool $toolsPool
     *
     * @return IDataPool
     */
    public function loadStateData(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->screen = 'mainGame';
        $dataPool->stateData->cellX = $dataPool->logicData->startCellX;
        $dataPool->stateData->cellY = $dataPool->logicData->startCellY;
        $dataPool->stateData->startUnixTime = time();

        return $dataPool;
    }
}
