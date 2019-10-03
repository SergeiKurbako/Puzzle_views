<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\LogicWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

/**
 * Инструкция по выдаче чанка (участка лабиринта)
 */
class LogicWorkerGetChunkInstruction implements IInstruction
{
    public function getChunk(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $resultCellX = abs($dataPool->stateData->cellX - $dataPool->requestData->needChunkX);
        $resultCellY = abs($dataPool->stateData->cellY - $dataPool->requestData->needChunkY);

        // Проверка возможности получения чанка для переданной клетки
        if ($resultCellX < $dataPool->logicData->rangeOfChunkReceiving &&
            $resultCellY < $dataPool->logicData->rangeOfChunkReceiving
        ) {
            $cells = $toolsPool->logicTools->mazeChunkTool->getChunkCells(
                $dataPool->logicData->maze,
                $dataPool->requestData->needChunkX,
                $dataPool->requestData->needChunkY,
                $dataPool->logicData->chunkSize
            );

            $chunk = [
                'centerX' => $dataPool->requestData->needChunkX,
                'centerY' => $dataPool->requestData->needChunkY,
                'cells' => $cells
            ];

            $dataPool->logicData->chunk = $chunk;
        }

        return $dataPool;
    }

}
