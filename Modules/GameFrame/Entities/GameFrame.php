<?php

namespace Modules\GameFrame\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Games\Entities\V2Games;

class GameFrame extends Model
{
    protected $fillable = [];

    public function game()
    {
        return $this->hasOne(V2Games::class, 'id', 'game_id');
    }
}
