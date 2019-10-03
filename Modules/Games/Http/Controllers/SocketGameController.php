<?php

namespace Modules\Games\Http\Controllers;

use Modules\Games\Entities\V2Games;

class SocketGameController
{
    /**
     * Выполнение любого запроса, который приходит в игру
     *
     * @return json ответ в формате json
     */
    public function action(array $requestArray)
    {
        $gameId = (int) $requestArray['game_id'];
        $mode = (string) $requestArray['mode'];

        $game = V2Games::find($gameId);

        $directorName = '\Modules\Games\Games\\' . ucfirst($game->type) . 's\\' . ucfirst($game->name) . 'Maze\GameDirector';

        $response = (new $directorName())
        ->build($mode)
        ->executeAction($requestArray);

        return $response;
    }
}
