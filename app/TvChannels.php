<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvChannels extends Model
{
    protected $table = 'tv_channels';

    protected $fillable = ['name', 'country_id', 'category_id', 'photo_link','description'];

    public $timestamps = false;

    public function country()
    {
        return $this->hasOne(Countries::class, 'id','country_id');
    }
    public function category()
    {
        return $this->hasOne(Categories::class, 'id','category_id');
    }
}
