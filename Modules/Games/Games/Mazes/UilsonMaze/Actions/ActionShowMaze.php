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

class ActionShowMaze extends Action
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

        // восстановление состояния
        $dataPool = $workersPool->recoveryWorker->recoveryData($dataPool, $toolsPool);

        $boolMaze = $toolsPool->logicTools->mazeTranscoderTool->transcodeObject(
            $dataPool->logicData->maze
        );
        $toolsPool->logicTools->mazeViewerTool->view($boolMaze);

        // подготовка данных для фронта
        $response = $workersPool->responseWorker->makeResponse($dataPool, $toolsPool);

        // Сохранение данных для последующего востановления
        //$workersPool->recoveryWorker->saveRecoveryData($dataPool, $toolsPool);

        return $response;
    }
}
