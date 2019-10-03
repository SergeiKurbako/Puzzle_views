<?php

namespace Modules\Games\Games\Mazes\EllerMaze2\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeStringTranscoderTool implements ITool
{
    public function transcodeToBoolMaze(array $mazeStringArray)
    {
        $boolMaze = [];

        // убараем замкнутые ячейки


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
            array_unshift($mazeString, 1);
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
                $mazeCell['topWall'] === true ? $string1[] = 1 : $string1[] = 0;
                $mazeCell['topWall'] === true ? $string1[] = 1 : $string1[] = 0;
                $string1[] = 1;
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
                $string3[] = 0;
                $string3[] = 0;
                $mazeCell['rightWall'] === true ? $string3[] = 1 : $string3[] = 0;
            }
            $strings3[] = $string3;
        }

        foreach ($mazeStringArray as $key => $value) {
            $boolMaze[] = $strings1[$key];
            $boolMaze[] = $strings2[$key];
            $boolMaze[] = $strings3[$key];
        }

        foreach ($boolMaze as $key => $mazeString) {
            array_unshift($mazeString, 1);
            $boolMaze[$key] = $mazeString;
        }

        $width = count($boolMaze[0]);
        $lastString = [];
        for ($i=0; $i < $width; $i++) {
            $lastString[] = 1;
        }
        $boolMaze[] = $lastString;

        $boolMaze[0][1] = 0;
        $boolMaze[0][2] = 0;

        $boolMaze[0][1] = 0;
        $boolMaze[count($boolMaze) - 1][count($lastString) - 2] = 0;
        $boolMaze[count($boolMaze) - 1][count($lastString) - 3] = 0;

        return $boolMaze;
    }
}
