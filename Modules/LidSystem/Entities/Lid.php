<?php

namespace Modules\LidSystem\Entities;

use Illuminate\Database\Eloquent\Model;

class Lid extends Model
{
    protected $fillable = [];

    public function complaint()
    {
        return $this->hasOne('Modules\LidSystem\Entities\Complaint', 'lid_id', 'id');
    }
}
