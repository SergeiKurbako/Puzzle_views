<?php

namespace Modules\Games\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Games\Entities\V2Games;
use Modules\Games\Entities\V2RecoveryData;

class GamesController extends Controller
{
    /**
     * Выполнение любого запроса, который приходит в игру
     *
     * @return json ответ в формате json
     */
    public function action(Request $request)
    {
        $gameId = (int) $request->game_id;
        $mode = (string) $request->mode;

        $game = V2Games::find($gameId);

        $directorName = '\Modules\Games\Games\\' . ucfirst($game->type) . 's\\' . ucfirst($game->name) . 'Maze\GameDirector';

        $response = (new $directorName())
        ->build($mode)
        ->executeAction($request->all());

        return $response;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('games::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('games::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    public function getSession($sessionId)
    {
        // получение всех сохраненных данных
        $recoveryData = V2RecoveryData::where('session_id', $sessionId)->get();

        return $recoveryData;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('games::edit');
    }
}
