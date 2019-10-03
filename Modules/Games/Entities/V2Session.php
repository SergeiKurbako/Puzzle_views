<?php

namespace Modules\Games\Entities;

use Illuminate\Database\Eloquent\Model;

class V2Session extends Model
{
    protected $fillable = [];

    public function recoveryData()
    {
        return $this->hasMany(
            '\Modules\Games\Entities\V2RecoveryData',
            'session_id',
            'id'
        );
    }
}
