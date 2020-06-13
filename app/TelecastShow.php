<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelecastShow extends Model
{
    protected $table = 'telecast_show';

    protected $fillable = ['telecast_id', 'show_start', 'show_end'];

    public $timestamps = false;

    public function telecasts()
    {
        return $this->hasOne(Telecasts::class, 'id','telecast_id');
    }
}
