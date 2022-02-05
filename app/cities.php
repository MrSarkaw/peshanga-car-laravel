<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\amer;
use App\automobiles;
class cities extends Model
{
    protected $fillable=['city_name','user_id'];
    protected $primaryKey='city_id';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user2()
    {
        return $this->hasMany(User::class, 'city_id');
    }

    public function amer()
    {
        return $this->hasMany('App\amer', 'city_id');
    }
    


    
}
