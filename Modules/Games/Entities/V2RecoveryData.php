<?php

namespace Modules\Games\Entities;

use Illuminate\Database\Eloquent\Model;

class V2RecoveryData extends Model
{
    protected $fillable = [];

    public function session()
    {
        return $this->hasOne('V2Session', 'id', 'session_id');
    }
}
