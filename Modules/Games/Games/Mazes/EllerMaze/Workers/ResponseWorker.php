<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Workers;

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

        // создание объекта для ответа с данными логики
        $logicData = clone $dataPool->logicData;

        $responseData->logicData = $logicData;

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
