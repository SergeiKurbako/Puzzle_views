<?php

namespace Modules\Games\Games\Mazes\EllerMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class LastMazeStringTool implements ITool
{
    // union cell with different number sets and make wall between their
    public function getLastMazeString(array $mazeString, int $width): array
    {


        // сделать проверку, которая соединяет последнюю строку с "полом", но
        // при этом не замыкает пол и потолок
        //
        // второе нужно убрать "островные" стенки

        // $count = $width - 1;
        // for ($i=0; $i < $count; $i++) {
        //     if ($mazeString[$i]['numberSet'] !== $mazeString[$i + 1]['numberSet']) {
        //         $mazeString[$i]['rightWall'] = false;
        //         $mazeString[$i + 1]['numberSet'] = $mazeString[$i]['numberSet'];
        //     } else {
        //         if ($mazeString[$i]['bottomWall'] === false && $mazeString[$i + 1]['bottomWall'] === false) {
        //             $mazeString[$i]['rightWall'] = true;
        //         }
        //     }
        // }

        return $mazeString;
    }
}
