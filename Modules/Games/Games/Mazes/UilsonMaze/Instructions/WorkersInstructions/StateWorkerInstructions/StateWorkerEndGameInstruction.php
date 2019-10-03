<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\StateWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;
use Modules\Games\Repositories\SessionRepository;

/**
 * Окончание игры. Должно случаться в том случае, если пользователь прошел игру
 */
class StateWorkerEndGameInstruction implements IInstruction
{
    public function checkWin(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->stateData->action = 'end_game';
        $dataPool->stateData->message = '';
        $dataPool->stateData->endUnixTime = time();
        $isWin = true;

        // получение всех ходов сделанных в данной сессии
        $allRecoveryData = SessionRepository::getAllReciveryData($dataPool->sessionData->sessionUuid);

        // проверка правильности выполнения всех ходов
        $countOfEndGame = 0;
        foreach ($allRecoveryData as $recoveryData) {
            $permittedMove = true;


            $recoveryDataPool = \json_decode($recoveryData->recovery_data);

            if ($recoveryDataPool->stateData->action === 'move') {
                $permittedMove = $toolsPool->logicTools->mazeMoveTool->checkMoveRange(
                    $recoveryDataPool->stateData->cellX,
                    $recoveryDataPool->stateData->cellY,
                    $recoveryDataPool->requestData->cellX,
                    $recoveryDataPool->requestData->cellY
                );

                $permittedMove = $toolsPool->logicTools->mazeMoveTool->checkMoveThroughWall(
                    $recoveryDataPool->stateData->cellX,
                    $recoveryDataPool->stateData->cellY,
                    $recoveryDataPool->requestData->cellX,
                    $recoveryDataPool->requestData->cellY,
                    $recoveryDataPool->logicData->maze
                );
            }

            if ($recoveryDataPool->stateData->action === 'end_game') {
                $countOfEndGame += 1;
            }

            if ($permittedMove === false) {
                $isWin = false;
                break;
            }
        }

        // проверка кол-ва выполненых окончаний игры
        if ($countOfEndGame > 1) {
            $dataPool->stateData->message .= 'countOfEndGame > 1|';
            $isWin = false;
        }

        // проверка кол-ва жизней
        if ($recoveryDataPool->stateData->health === 0) {
            $dataPool->stateData->message .= 'health === 0|';
            $isWin = false;
        }

        // проверка находится ли пользователь в конечной точке
        if ($recoveryDataPool->stateData->cellX !== $recoveryDataPool->logicData->endCellX ||
            $recoveryDataPool->stateData->cellY !== $recoveryDataPool->logicData->endCellX) {
            $dataPool->stateData->message .= 'не совпадают конечные точки с положением игрока|';
            $isWin = false;
        }

        // проверка не истекло ли время
        $deltaTime = $dataPool->stateData->endUnixTime - $dataPool->stateData->startUnixTime;
        $haveTime = $dataPool->stateData->startUnixTime + $dataPool->stateData->time;
        if ($haveTime < $deltaTime) {
            $dataPool->stateData->message .= '$haveTime < $deltaTime|';
            $isWin = false;
        }

        if ($isWin === true) {
            $dataPool->stateData->isWin = true;
        } else {
            $dataPool->stateData->isWin = false;
        }

        return $dataPool;
    }

    public function saveGameResultForLid(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $toolsPool->sessionTools->lidTool->saveGameResultForLid(
            $dataPool->sessionData->lidId,
            $dataPool->stateData->isWin,
            $dataPool->sessionData->sessionUuid
        );

        return $dataPool;
    }
}
