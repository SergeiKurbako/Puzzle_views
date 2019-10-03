<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\Actions;

use Avior\GameCore\Base\IWorkersPool;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;
use Avior\GameCore\Base\IRequestDataSets;
use Avior\GameCore\Base\IInstructionsPool;
use Avior\GameCore\Tools\RecoveryDataTool;
use Avior\GameCore\Events\ActionEvents\StartActionOpenGameEvent;
use Avior\GameCore\Events\ActionEvents\EndActionOpenGameEvent;
use Avior\GameCore\Actions\Action;

/**
 * Класс выполняет действие запуска игры на сервере
 */
class ActionOpenGame extends Action
{
    /**
     * Выполнение действия запуска игры
     *
     * @param  array             $requestArray     [description]
     * @param  IWorkersPool      $workersPool      [description]
     * @param  IDataPool         $dataPool         [description]
     * @param  IToolsPool        $toolsPool        [description]
     * @param  IInstructionsPool $instructionsPool [description]
     * @param  IRequestDataSets  $requestDataSets  [description]
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

        // загрузка логики
        $dataPool = $workersPool->logicWorker->executeInstruction(
            $dataPool,
            $toolsPool,
            $instructionsPool->logicWorkerInstructions->loadData
        );
        // подготовка данных для фронта
        $response = $workersPool->responseWorker->makeResponse($dataPool, $toolsPool);

        return $response;
    }
}
