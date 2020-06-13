<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = ['FIO', 'channel_id', 'position_id'];

    public $timestamps = false;
}
