<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeTranscoderTool implements ITool
{
    // конвертация лабиринта в bool
    public function transcode(array $maze): array
    {

        $boolMaze = [];

        $strings1 = [];
        foreach ($maze as $key => $mazeString) {
            $string1 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $string1[] = 0;
                $string1[] = 0;
                $mazeCell['rightWall'] === true ? $string1[] = 1 : $string1[] = 0;
            }
            $strings1[] = $string1;
        }

        $strings2 = [];
        foreach ($maze as $key => $mazeString) {
            $string2 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $string2[] = 0;
                $string2[] = 0;
                $mazeCell['rightWall'] === true ? $string2[] = 1 : $string2[] = 0;
            }
            $strings2[] = $string2;
        }

        $strings3 = [];
        foreach ($maze as $key => $mazeString) {
            $string3 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $mazeCell['bottomWall'] === true ? $string3[] = 1 : $string3[] = 0;
                $mazeCell['bottomWall'] === true ? $string3[] = 1 : $string3[] = 0;
                $string3[] = 1;
            }
            $strings3[] = $string3;
        }

        foreach ($maze as $key => $value) {
            $boolMaze[] = $strings1[$key];
            $boolMaze[] = $strings2[$key];
            $boolMaze[] = $strings3[$key];
        }

        return $boolMaze;
    }

    // конвертация лабиринта в bool
    public function transcodeObject(array $maze): array
    {

        $boolMaze = [];

        $strings1 = [];
        foreach ($maze as $key => $mazeString) {
            $string1 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $string1[] = 0;
                $string1[] = 0;
                $mazeCell->rightWall === true ? $string1[] = 1 : $string1[] = 0;
            }
            $strings1[] = $string1;
        }

        $strings2 = [];
        foreach ($maze as $key => $mazeString) {
            $string2 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $string2[] = 0;
                $string2[] = 0;
                $mazeCell->rightWall === true ? $string2[] = 1 : $string2[] = 0;
            }
            $strings2[] = $string2;
        }

        $strings3 = [];
        foreach ($maze as $key => $mazeString) {
            $string3 = [];
            foreach ($mazeString as $key2 => $mazeCell) {
                $mazeCell->bottomWall === true ? $string3[] = 1 : $string3[] = 0;
                $mazeCell->bottomWall === true ? $string3[] = 1 : $string3[] = 0;
                $string3[] = 1;
            }
            $strings3[] = $string3;
        }

        foreach ($maze as $key => $value) {
            $boolMaze[] = $strings1[$key];
            $boolMaze[] = $strings2[$key];
            $boolMaze[] = $strings3[$key];
        }

        return $boolMaze;
    }
}
