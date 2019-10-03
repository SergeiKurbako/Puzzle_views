<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class GeneratorTool implements ITool
{
    public function generation($toolsPool, $width, $height)
    {
        $unionMazeStrings = $this->tryGeneration($toolsPool, $width, $height);

        // проврка наличия достаточного кол-ва стенок на нижнем ряду
        $countRightWall = 0;
        foreach ($unionMazeStrings[$height - 1] as $key => $mazeCell) {
            if ($mazeCell['rightWall'] === true) {
                $countRightWall += 1;
            }
        }
        // if ($countRightWall < $width / 8) {
        //     $unionMazeStrings =  $this->generation($toolsPool, $width, $height);
        // }

        return $unionMazeStrings;
    }

    protected function tryGeneration($toolsPool, $width, $height)
    {
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
        ->union($firstMazeString, $otherMazeStrings, $lastMazeString);


        return $unionMazeStrings;
    }
}
