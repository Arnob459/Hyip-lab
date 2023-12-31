<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReward extends Model
{
    protected $guarded = ['id'];



    public function user()
    {
        return $this->belongsTo(USer::class);
    }
}
