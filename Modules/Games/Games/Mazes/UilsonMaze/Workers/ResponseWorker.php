<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Workers;

use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;
use Avior\GameCore\Data\DataPool;
use Avior\GameCore\Workers\Worker;

/**
 * Класс занимается генерацией ответа для фронта
 */
class ResponseWorker extends Worker
{
    /**
     * Генерация ответа для фронта
     *
     * @param IDataPool $dataPool
     *
     * @return string json-данные
     */
    public function makeResponse(IDataPool $dataPool): string
    {
        $responseData = new \stdClass;

        $responseData->logicData = clone $dataPool->logicData;
        unset($responseData->logicData->maze);
        // unset($responseData->logicData->mazeWidth);
        // unset($responseData->logicData->mazeHeight);
        // unset($responseData->logicData->chunkSize);
        // unset($responseData->logicData->rangeOfChunkReceiving);
        // unset($responseData->logicData->startCellX);
        // unset($responseData->logicData->startCellY);
        // unset($responseData->logicData->endCellX);
        // unset($responseData->logicData->endCellY);
        unset($responseData->logicData->maxHealth);
        unset($responseData->logicData->minHealth);
        unset($responseData->logicData->minSpeed);
        unset($responseData->logicData->maxSpeed);
        unset($responseData->logicData->countOfSpeedBonus);
        // unset($responseData->logicData->countOfHealthBonus);
        // unset($responseData->logicData->countOfTimeBonus);
        // unset($responseData->logicData->speedBonusValue);
        // unset($responseData->logicData->healthBonusValue);
        unset($responseData->logicData->timeBonusValue);
        if ($dataPool->stateData->action === 'get_chunk' || $dataPool->stateData->action === 'open_game') {
        } else {
            unset($responseData->logicData->chunk);
        }

        $responseData->sessionData = clone $dataPool->sessionData;
        unset($responseData->sessionData->userId);
        unset($responseData->sessionData->lidId);
        unset($responseData->sessionData->gameId);
        unset($responseData->sessionData->mode);
        //unset($responseData->sessionData->sessionUuid);

        $responseData->stateData = clone $dataPool->stateData;
        unset($responseData->stateData->botPositions);
        unset($responseData->stateData->screen);
        // unset($responseData->stateData->action);
        unset($responseData->stateData->startUnixTime);
        unset($responseData->stateData->endUnixTime);
        unset($responseData->stateData->currentMicroTime);

        return \json_encode($responseData);
    }

    /**
     * Метод отправляющий уведомления о событиях
     *
     * @param  IDataPool  $dataPool  [description]
     * @param  IToolsPool $toolsPool [description]
     *
     * @return IDataPool             [description]
     */
    protected function sendNotifies(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        return $dataPool;
    }
}
