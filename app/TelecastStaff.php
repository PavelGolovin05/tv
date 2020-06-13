<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelecastStaff extends Model
{
    protected $table = 'telecast_staff';

    protected $fillable = ['telecast_id', 'staff_id'];

    public $timestamps = false;
}
