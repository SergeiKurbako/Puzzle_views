<?php

namespace Modules\Games\Games\Mazes\UilsonMaze\Tools\LogicTools;

use Avior\GameCore\Base\ITool;

class MazeViewerTool implements ITool
{
    public function view(array $boolMaze): void
    {
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
    }
}
