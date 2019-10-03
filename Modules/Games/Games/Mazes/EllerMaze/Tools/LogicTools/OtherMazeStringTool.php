<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class OtherMazeStringTool implements ITool
{
    public function getOtherMazeStringWithoutLastString(
        array $firstMazeString,
        int $height,
        int $width
    ): array {
        $mazeStringArray = [];
        $mazeStringArray[] = $firstMazeString;

        for ($k = 1; $k < $height - 1; $k++) {
            // make new maze string
            $mazeString = $mazeStringArray[$k - 1];

            // if cell have bottom wall then remove her number set
            // and remove all bottom wall
            // and remove all left wall
            $mazeString = $this->removeNumberSet($mazeString);

            // if maze cell don't have number set, then give her this
            $mazeString = $this->setNumberSets($mazeString);

            // if two cell have a same set number, then make wall
            //$mazeString = $this->makeWall($mazeString, $width);

            // make random left wall for next cell
            $mazeString = $this->makeRandomLeftWallForNextCell($mazeString, $width);

            // get array of different number sets
            $numberSets = $this->getArrayOfDifferentNumberSets($mazeString);

            // make random bottom wall
            $mazeString = $this->makeRandomBottomWall($numberSets, $mazeString);

            $mazeStringArray[] = $mazeString;
        }

        // $mazeStringArray = \unserialize('a:5:{i:0;a:5:{i:0;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:1;a:3:{s:9:"numberSet";i:1;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:2;a:3:{s:9:"numberSet";i:2;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:3;a:3:{s:9:"numberSet";i:2;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:4;a:3:{s:9:"numberSet";i:2;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}}i:1;a:5:{i:0;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:1;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:2;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}i:3;a:3:{s:9:"numberSet";i:0;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:4;a:3:{s:9:"numberSet";i:4;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}}i:2;a:5:{i:0;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:1;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:2;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:3;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}i:4;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:0;}}i:3;a:5:{i:0;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:1;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:2;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:0;}i:3;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:4;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}}i:4;a:5:{i:0;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:1;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:2;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:3;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:1;s:10:"bottomWall";b:1;}i:4;a:3:{s:9:"numberSet";i:5;s:9:"rightWall";b:0;s:10:"bottomWall";b:1;}}}');

        $lastMazeString = $mazeString;
        foreach ($lastMazeString as $key => $mazeCell) {
            $lastMazeString[$key]['bottomWall'] = true;

            if ($key < $width - 1) {
                if ($lastMazeString[$key]['numberSet'] !== $lastMazeString[$key + 1]['numberSet']) {
                    if ($mazeStringArray[$height - 2][$key]['numberSet'] !== $mazeStringArray[$height - 2][$key + 1]['numberSet']) {
                        $lastMazeString[$key]['rightWall'] = false;
                    }
                    //$lastMazeString[$key + 1]['numberSet'] = $lastMazeString[$key]['numberSet'];
                    // if ($lastMazeString[$key]['rightWall'] === false) {
                    // }
                } else {
                    if ($mazeStringArray[$height - 2][$key]['bottomWall'] === false) {
                        $lastMazeString[$key]['rightWall'] = true;
                    }
                }
            }

            // if ($key < $width - 1 && $key > 0) {
            //     if ($lastMazeString[$key]['numberSet'] !== $lastMazeString[$key + 1]['numberSet']) {
            //         if ($mazeStringArray[$height - 2][$key]['bottomWall'] === false && $lastMazeString[$key - 1]['rightWall'] === false) {
            //             $lastMazeString[$key]['rightWall'] = true;
            //         }
            //         //$lastMazeString[$key + 1]['numberSet'] = $lastMazeString[$key]['numberSet'];
            //     } else {
            //         $lastMazeString[$key]['rightWall'] = true;
            //     }
            // }
        }

        foreach ($lastMazeString as $key => $mazeCell) {
            if ($key < $width - 1) {
                if ($lastMazeString[$key]['rightWall'] === true && $lastMazeString[$key + 1]['rightWall'] === true) {
                    $lastMazeString[$key + 1]['rightWall'] = false;
                }
            }
        }

        // убираем у предпоследней ячейки стенку
        $lastMazeString[$width - 2]['rightWall'] = false;
        $lastMazeString[$width - 3]['rightWall'] = false;
        $lastMazeString[0]['rightWall'] = false;
        $mazeStringArray[$height - 2][$width - 1]['bottomWall'] = false;
        $mazeStringArray[$height - 2][$width - 2]['bottomWall'] = false;
        $mazeStringArray[$height - 2][0]['bottomWall'] = false;
        $mazeStringArray[$height - 2][0]['rightWall'] = false;

        $mazeStringArray[] = $lastMazeString;

        //dd($mazeStringArray);

        return $mazeStringArray;
    }

    protected function getActiveNumberSets(array $mazeString): array
    {
        $activeNumberSets = [];
        foreach ($mazeString as $mazeCell) {
            if (!in_array($mazeCell['numberSet'], $activeNumberSets)) {
                $activeNumberSets[] = $mazeCell['numberSet'];
            }
        }

        return $activeNumberSets;
    }

    protected function removeNumberSet(array $mazeString): array
    {
        $newMazeString = [];
        foreach ($mazeString as $key => $mazeCell) {
            $mazeCell['rightWall'] = false;

            if ($mazeCell['bottomWall'] === true) {
                $mazeCell['numberSet'] = 0;
            }

            $mazeCell['bottomWall'] = false;

            // if ($key !== 0) {
            //     $mazeCell['leftWall'] = false;
            // }

            $newMazeString[] = $mazeCell;
        }

        return $newMazeString;
    }

    protected function setNumberSets(array $mazeString): array
    {
        // get active number sets
        $activeNumberSets = $this->getActiveNumberSets($mazeString);

        foreach ($mazeString as $key => $mazeCell) {
            if ($mazeCell['numberSet'] === 0) {
                $newMax = max($activeNumberSets) + 1;
                $mazeString[$key]['numberSet'] = $newMax;
                $activeNumberSets[] = $newMax;
            }

            $newMazeString[] = $mazeCell;
        }

        return $mazeString;
    }

    // protected function makeWall(array $mazeString, int $width)
    // {
    //     $prevMazeCell = [];
    //     foreach ($mazeString as $key => $mazeCell) {
    //         if ($key !== 0) {
    //             if ($mazeCell['numberSet'] === $prevMazeCell['numberSet']) {
    //                 $mazeCell['leftWall'] = true;
    //                 $mazeString[$key] = $mazeCell;
    //             }
    //         }
    //
    //         $prevMazeCell = $mazeCell;
    //     }
    //
    //     return $mazeString;
    // }

    protected function makeRandomLeftWallForNextCell(array $mazeString, int $width): array
    {
        for ($i=0; $i < ($width - 1); $i++) {
            $rand = rand(0, 1);
            if ($mazeString[$i]['numberSet'] === $mazeString[$i + 1]['numberSet']) {
                // if ($rand) {
                //     $mazeString[$i]['rightWall'] = true;
                // } else {
                //     $mazeString[$i]['rightWall'] = false;
                //     $mazeString[$i + 1]['numberSet'] = $mazeString[$i]['numberSet'];
                // }

                $mazeString[$i]['rightWall'] = true;

                // get active number sets
                $activeNumberSets = $this->getActiveNumberSets($mazeString);
                $mazeString[$i]['numberSet'] = max($activeNumberSets) + 1;
            } else {
                if ($rand) {
                    $mazeString[$i]['rightWall'] = true;
                } else {
                    $mazeString[$i]['rightWall'] = false;
                    $mazeString[$i + 1]['numberSet'] = $mazeString[$i]['numberSet'];
                }
            }
        }

        return $mazeString;
    }

    protected function getArrayOfDifferentNumberSets(array $mazeString)
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
                if(rand(0, 1)) {
                    $mazeString[$numberSet[$key]]['bottomWall'] = true;
                }
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

            // check don't have bottom wall
            if (count($numberSet) > 1) {
                $checkBottomWall = false;
                foreach ($numberSet as $key => $value) {
                    if ($mazeString[$numberSet[$key]]['bottomWall'] === true) {
                        $checkBottomWall = true;
                    }
                }

                if ($checkBottomWall === false) {
                    $cellKey = array_rand($numberSet);
                    $mazeString[$numberSet[$cellKey]]['bottomWall'] = true;
                }
            }
        }

        return $mazeString;
    }
}
