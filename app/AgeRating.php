<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeRating extends Model
{
    protected $table = 'age_rating';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function telecasts()
    {
        return $this->hasMany(Telecasts::class, 'age_rating_id','id');
    }
}
