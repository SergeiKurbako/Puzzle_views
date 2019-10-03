<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeStringTranscoderTool implements ITool
{
    public function transcodeToBoolMaze(array $mazeStringArray)
    {
        $boolMaze = [];

        $notEvenStrings = [];
        foreach ($mazeStringArray as $stringNumber => $mazeString) {
            foreach ($mazeString as $cellNumber => $mazeCell) {
                $mazeCell['topWall'] === true ? $notEvenStrings[$stringNumber][] = 1 : $notEvenStrings[$stringNumber][] = 0;
                $mazeCell['rightWall'] === true ? $notEvenStrings[$stringNumber][] = 1 : $notEvenStrings[$stringNumber][] = 0;
            }
        }

        $evenStrings = [];
        foreach ($mazeStringArray as $stringNumber => $mazeString) {
            foreach ($mazeString as $cellNumber => $mazeCell) {
                $evenStrings[$stringNumber][] = 0;
                $mazeCell['rightWall'] === true ? $evenStrings[$stringNumber][] = 1 : $evenStrings[$stringNumber][] = 0;
            }
        }

        for ($i = 0; $i < count($evenStrings); $i++) {
            $boolMaze[] = $notEvenStrings[$i];
            $boolMaze[] = $evenStrings[$i];
        }

        foreach ($boolMaze as $key => $mazeString) {
            array_unshift($mazeString, 7);
            $boolMaze[$key] = $mazeString;
        }

        $width = count($boolMaze[0]);
        $lastString = [];
        for ($i=0; $i < $width; $i++) {
            $lastString[] = 1;
        }
        $boolMaze[] = $lastString;

        return $boolMaze;
    }

    public function transcodeToBoolMaze2(array $mazeStringArray): array
    {
        $boolMaze = [];

        $strings1 = [];
        foreach ($mazeStringArray as $key => $mazeString) {
            $string1 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $string1[] = 0;
                $string1[] = 0;
                $mazeCell['rightWall'] === true ? $string1[] = 1 : $string1[] = 0;
            }
            $strings1[] = $string1;
        }

        $strings2 = [];
        foreach ($mazeStringArray as $key => $mazeString) {
            $string2 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $string2[] = 0;
                $string2[] = 0;
                $mazeCell['rightWall'] === true ? $string2[] = 1 : $string2[] = 0;
            }
            $strings2[] = $string2;
        }

        $strings3 = [];
        foreach ($mazeStringArray as $key => $mazeString) {
            $string3 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $mazeCell['bottomWall'] === true ? $string3[] = 1 : $string3[] = 0;
                $mazeCell['bottomWall'] === true ? $string3[] = 1 : $string3[] = 0;
                $string3[] = 1;
            }
            $strings3[] = $string3;
        }

        foreach ($mazeStringArray as $key => $value) {
            $boolMaze[] = $strings1[$key];
            $boolMaze[] = $strings2[$key];
            $boolMaze[] = $strings3[$key];
        }

        foreach ($boolMaze as $stringKey => $mazeString) {
            foreach ($mazeString as $cellKey => $mazeCell) {
                if ($cellKey === 0) {
                    array_unshift($boolMaze[$stringKey], 1);
                }

                $count = count($mazeString) - 1;
                if ($cellKey === $count) {
                    $boolMaze[$stringKey][$cellKey + 1] = 1;
                }
            }
        }

        $wall = [];
        $count = count($mazeString) + 1;
        for ($i=0; $i < $count; $i++) {
            $wall[] = 1;
        }
        array_unshift($boolMaze, $wall);

        $boolMaze[count($boolMaze) - 1] = $wall;

        return $boolMaze;
    }
}
