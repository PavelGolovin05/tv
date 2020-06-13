<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFavouriteChannel extends Model
{
    protected $table = 'user_favourite_channel';

    protected $fillable = ['user_id', 'channel_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function channel()
    {
        return $this->hasOne(TvChannels::class, 'id','channel_id');
    }

}
