<?php

namespace Modules\Games\Tests\Unit\FirstMaze;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Games\Games\Mazes\FirstMaze\GameDirector as FMGameDirector;

class OpenGameTest extends TestCase
{
    public function testOpenGame()
    {
        $mode = 'full';

        $response = (new FMGameDirector())
        ->build($mode)
        ->executeAction([
            "action" => "open_game",
            "maze_width" => "11",
            "maze_height" => "11",
            "game_id" => 1
        ]);

        $this->assertIsString($response);
    }
}
