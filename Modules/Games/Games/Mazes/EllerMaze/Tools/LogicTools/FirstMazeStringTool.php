<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class FirstMazeStringTool implements ITool
{
    public function getFirstMazeString(int $width): array
    {
        // first string filling
        $mazeString = $this->getFirstStringFilling($width);

        // make random left wall for next cell
        $mazeString = $this->makeRandomRightWallForNextCell($mazeString, $width);

        // get array of different number sets
        $numberSets = $this->getArrayOfDifferentNumberSets($mazeString);

        // make random bottom wall
        $mazeString = $this->makeRandomBottomWall($numberSets, $mazeString);

        return $mazeString;
    }

    protected function getFirstStringFilling(int $width): array
    {
        $mazeString = [];
        for ($i = 0; $i < $width; $i++) {
            $mazeCell = [
                'numberSet' => $i,
                'rightWall' => false,
                'bottomWall' => false
            ];

            $mazeString[] = $mazeCell;
        }

        return $mazeString;
    }

    protected function makeRandomRightWallForNextCell(array $mazeString, int $width): array
    {
        for ($i=0; $i < ($width - 1); $i++) {
            $rand = rand(0, 1);

            if ($rand) {
                $mazeString[$i]['rightWall'] = true;
            } else {
                $mazeString[$i + 1]['numberSet'] = $mazeString[$i]['numberSet'];
            }
        }

        return $mazeString;
    }

    protected function getArrayOfDifferentNumberSets(array $mazeString): array
    {
        $numberSets = [];
        foreach ($mazeString as $key => $mazeCell) {
            $numberSets[$mazeCell['numberSet']][] = $key;
        }

        return $numberSets;
    }

    protected function makeRandomBottomWall(array $numberSets, array $mazeString): array
    {
        foreach ($numberSets as $numberSet) {
            foreach ($numberSet as $key => $value) {
                $mazeString[$numberSet[$key]]['bottomWall'] = true;
                // if(rand(0, 1)) {
                // }
            }


            // check have bottom hall
            $checkBottomHall = false;
            foreach ($numberSet as $key => $value) {
                if ($mazeString[$numberSet[$key]]['bottomWall'] === false) {
                    $checkBottomHall = true;
                }
            }

            if ($checkBottomHall === false) {
                $cellKey = array_rand($numberSet);
            	$mazeString[$numberSet[$cellKey]]['bottomWall'] = false;
            }
        }

        return $mazeString;
    }
}
