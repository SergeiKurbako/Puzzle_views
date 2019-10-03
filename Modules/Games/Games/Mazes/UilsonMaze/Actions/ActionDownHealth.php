<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Actions;

use Avior\GameCore\Base\IWorkersPool;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;
use Avior\GameCore\Base\IRequestDataSets;
use Avior\GameCore\Base\IInstructionsPool;
use Avior\GameCore\Tools\RecoveryDataTool;
use Avior\GameCore\Events\ActionEvents\StartActionOpenGameEvent;
use Avior\GameCore\Events\ActionEvents\EndActionOpenGameEvent;
use Avior\GameCore\Actions\Action;

class ActionDownHealth extends Action
{
    /**
     * Повышения кол-ва жизней
     *
     * @param  array             $requestArray
     * @param  IWorkersPool      $workersPool
     * @param  IDataPool         $dataPool
     * @param  IToolsPool        $toolsPool
     * @param  IInstructionsPool $instructionsPool
     * @param  IRequestDataSets  $requestDataSets
     *
     * @return string                              json
     */
    public function __invoke(
        array $requestArray,
        IWorkersPool $workersPool,
        IDataPool $dataPool,
        IToolsPool $toolsPool,
        IInstructionsPool $instructionsPool,
        IRequestDataSets $requestDataSets
    ): string {
        // загрузка данных из запроса
        $dataPool = $workersPool->requestWorker->loadRequestData($requestArray, $dataPool, $toolsPool, $requestDataSets);

        // восстановление состояния
        $dataPool = $workersPool->recoveryWorker->recoveryData($dataPool, $toolsPool);

        // запись сделанного хода
        $dataPool = $workersPool->stateWorker->executeInstruction(
            $dataPool,
            $toolsPool,
            $instructionsPool->stateWorkerInstructions->downHealth
        );

        // подготовка данных для фронта
        $response = $workersPool->responseWorker->makeResponse($dataPool, $toolsPool);

        // Сохранение данных для последующего востановления
        $workersPool->recoveryWorker->saveRecoveryData($dataPool, $toolsPool);

        return $response;
    }
}
