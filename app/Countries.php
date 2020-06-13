<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function tv_channels()
    {
        return $this->hasMany(TvChannels::class, 'country_id','id');
    }
}
