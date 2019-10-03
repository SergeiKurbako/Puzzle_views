<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\Instructions\WorkersInstructions\LogicWorkerInstructions;

use Avior\GameCore\Base\IInstruction;
use Avior\GameCore\Base\IDataPool;
use Avior\GameCore\Base\IToolsPool;

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
        $dataPool->logicData->mazeWidth = $dataPool->requestData->mazeWidth;
        $dataPool->logicData->mazeHeight = $dataPool->requestData->mazeHeight;

        return $dataPool;
    }

    /**
     * Maze generation
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
        $width = $dataPool->logicData->mazeWidth;
        $height = $dataPool->logicData->mazeHeight;

        // get first maze string
        $firstMazeString = $toolsPool
        ->logicTools
        ->firstMazeStringTool
        ->getFirstMazeString($width);

        // get other maze string without last string
        $otherMazeStrings = $toolsPool
        ->logicTools
        ->otherMazeStringTool
        ->getOtherMazeStringWithoutLastString($firstMazeString, $height, $width);

        $lastMazeStringFromOtherStrings = $otherMazeStrings[count($otherMazeStrings) - 1];

        $lastMazeString = $toolsPool
        ->logicTools
        ->lastMazeStringTool
        ->getLastMazeString($lastMazeStringFromOtherStrings, $width);

        $unionMazeStrings = $toolsPool
        ->logicTools
        ->unionMazeStringsTool
        ->union($otherMazeStrings, $lastMazeString);

        //
        // сделать bool массив
        //

        $boolMaze = $toolsPool
        ->logicTools
        ->mazeStringTranscoderTool
        ->transcodeToBoolMaze2($unionMazeStrings);

        // отображение
        foreach ($boolMaze as $height => $widths) {
            foreach ($widths as $width => $value) {
                if ($value === 0) {
                    echo '&nbsp;&nbsp;';
                } else {
                    echo '7';
                }
            }
            echo '<br>';
        }

        dd(__METHOD__, $unionMazeStrings, $boolMaze);

        // foreach ($unionMazeStrings as $key => $mazeString) {
        //     foreach ($mazeString as $key2 => $mazeCell) {
        //         if ($mazeCell['leftWall']) {
        //             echo '|';
        //         }
        //         if ($mazeCell['bottomWall']) {
        //             echo '_';
        //         } else {
        //             echo '&nbsp;';
        //         }
        //     }
        //
        //     echo '<br>';
        // }

        // $leftWallSymbol = '|';
        // $bottomWallSymbol = '_';
        // $hallSymbol = 'O';
        // foreach ($unionMazeStrings as $key => $mazeString) {
        //     foreach ($mazeString as $key2 => $mazeCell) {
        //         if ($mazeCell['leftWall'] === true) {
        //             echo $leftWallSymbol .'';
        //         }
        //         echo $hallSymbol.'';
        //     }
        //     echo "<br>";
        //
        //     echo '&nbsp;';
        //     foreach ($mazeString as $key2 => $mazeCell) {
        //         if ($mazeCell['bottomWall'] === true) {
        //             echo $bottomWallSymbol .'';
        //             echo '&nbsp;';
        //         } else {
        //             echo '&nbsp;&nbsp;&nbsp;&nbsp;';
        //         }
        //     }
        //     echo "<br>";
        // }

        $dataPool->logicData->maze = $boolMaze;
        return $dataPool;
    }


}
