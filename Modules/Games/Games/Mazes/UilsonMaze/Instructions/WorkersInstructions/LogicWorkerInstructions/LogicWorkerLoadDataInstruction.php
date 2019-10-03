<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Instructions\WorkersInstructions\LogicWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;
use Modules\LidSystem\Entities\Lid;
use Modules\GameFrame\Entities\GameFrame;
use Modules\Games\Entities\V2GameRule;

/**
 * Класс содержащий набор методов, которые последовательно выполняются в воркером
 * Загрузка данных связанных с логикой игры.
 * Делается только при старте игры. Данные генерируются в независимости от
 * восстановления сессии
 */
class LogicWorkerLoadDataInstruction implements IInstruction
{
    public function loadRequestData(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->logicData->startCellX = 0;
        $dataPool->logicData->startCellY = 0;

        // получение правил
        $lid = Lid::find($dataPool->requestData->lidId);
        $frame = GameFrame::find($lid->frame_id);
        $ruleDB = V2GameRule::find($frame->game_rule_id);
        $rule = \json_decode($ruleDB->rules);

        $dataPool->logicData->mazeWidth = $rule->logicData->mazeWidth;
        $dataPool->logicData->mazeHeight = $rule->logicData->mazeHeight;
        $dataPool->logicData->endCellX = $rule->logicData->mazeWidth - 1;
        $dataPool->logicData->endCellY = $rule->logicData->mazeHeight - 1;
        $dataPool->logicData->cameraWidth = $rule->logicData->cameraWidth;
        $dataPool->logicData->cameraHeight = $rule->logicData->cameraHeight;
        $dataPool->logicData->countOfTimeBonus = $rule->logicData->countOfTimeBonus;
        $dataPool->logicData->countOfHealthBonus = $rule->logicData->countOfHealthBonus;
        $dataPool->logicData->decreaseTime = $rule->logicData->decreaseTime;
        $dataPool->stateData->speed = $rule->stateData->speed;
        $dataPool->stateData->health = $rule->stateData->health;
        $dataPool->stateData->time = $rule->stateData->time;
        $dataPool->stateData->botSpeed = $rule->stateData->botSpeed;

        if ($dataPool->logicData->cameraHeight > $rule->logicData->cameraWidth) {
            $chunkSize = $dataPool->logicData->cameraHeight * 2;
        } else {
            $chunkSize = $dataPool->logicData->cameraWidth * 2;
        }
        $dataPool->logicData->chunkSize = $chunkSize;
        $dataPool->logicData->rangeOfChunkReceiving = (int) $chunkSize / 2;

        $dataPool->stateData->action = $dataPool->requestData->action;

        return $dataPool;
    }

    /**
     * Генерация лабиринта
     *
     * @param  IDataPool  $dataPool  [description]
     * @param  IToolsPool $toolsPool [description]
     *
     * @return IDataPool             [description]
     */
    public function mazeGeneration(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $maze = $toolsPool->logicTools->mazeGenerationTool->generation(
            $dataPool->logicData->mazeWidth,
            $dataPool->logicData->mazeHeight
        );

        $boolMaze = $toolsPool->logicTools->mazeTranscoderTool->transcode(
            $maze
        );

        // $toolsPool->logicTools->mazeViewerTool->view(
        //     $boolMaze
        // );

        $dataPool->logicData->maze = $maze;

        return $dataPool;
    }

    public function addStartAndEndCellsInMaze(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->logicData->maze = $toolsPool
        ->logicTools
        ->mazeStartAndEndCellsTool
        ->addStartAndEndPointInMaze(
            $dataPool->logicData->maze,
            $dataPool->logicData->startCellX,
            $dataPool->logicData->startCellY,
            $dataPool->logicData->endCellX,
            $dataPool->logicData->endCellY
        );

        return $dataPool;
    }

    public function addBonuses(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $dataPool->logicData->maze = $toolsPool->logicTools->mazeBonusTool->addBonuses(
            $dataPool->logicData->maze,
            $dataPool->logicData->countOfSpeedBonus,
            $dataPool->logicData->countOfHealthBonus
        );

        return $dataPool;
    }

    public function getChunk(
        IDataPool $dataPool,
        IToolsPool $toolsPool
    ): IDataPool {
        $cells = $toolsPool->logicTools->mazeChunkTool->getChunkCells(
            $dataPool->logicData->maze,
            $dataPool->logicData->rangeOfChunkReceiving,
            $dataPool->logicData->rangeOfChunkReceiving,
            $dataPool->logicData->chunkSize
        );

        $chunk = [
            'centerX' => $dataPool->logicData->rangeOfChunkReceiving,
            'centerY' => $dataPool->logicData->rangeOfChunkReceiving,
            'cells' => $cells
        ];

        $dataPool->logicData->chunk = $chunk;

        return $dataPool;
    }

}
