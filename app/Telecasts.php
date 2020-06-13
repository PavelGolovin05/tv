<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telecasts extends Model
{
    protected $table = 'telecasts';

    protected $fillable = ['name','age_rating_id', 'channel_id', 'category_id'];

    public $timestamps = false;

    public function age_rating()
    {
        return $this->hasOne( AgeRating::class, 'id','age_rating_id');
    }
    public function category()
    {
        return $this->hasOne( Categories::class, 'id','category_id');
    }
    public function channel_id()
    {
        return $this->hasOne( TvChannels::class, 'id','channel_id');
    }
}
