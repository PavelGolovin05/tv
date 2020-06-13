<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name','is_channel_type'];

    public $timestamps = false;

    public function tv_channels()
    {
        return $this->hasMany(TvChannels::class, 'category_id','id');
    }
    public function telecasts()
    {
        return $this->hasMany(Telecasts::class, 'category_id','id');
    }
}
