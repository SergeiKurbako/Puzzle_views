<?php

namespace Modules\LidSystem\Entities;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [];

    public function lid()
    {
        return $this->hasOne('Modules\LidSystem\Entities\Lid', 'id', 'lid_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
