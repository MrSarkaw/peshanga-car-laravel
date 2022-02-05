<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\automobiles;
use App\companies;
use App\cities;
use App\main_sections;
use App\roles;
use App\ashya;
use App\sponser;
use App\office;
use App\reportFroshtn;
use App\qestShahn;
use App\amer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','role_id','phone_number','city_id','company'
    ];

    protected $primaryKey="user_id";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role(){
        return $this->belongsTo(roles::class,'role_id');
    }

    public function automobiles(){
       return $this->hasMany(automobiles::class,'user_id');
    }

    public function companies(){
        return $this->hasMany(companies::class,'user_id');
    }


    public function cities(){
        return $this->hasMany(cities::class,'user_id');
     }

     public function cities2(){
        return $this->belongsTo(cities::class,'city_id');
     }

    public function main_sections(){
        return $this->hasMany(main_sections::class,'user_id');
    }

    public function main_menus(){
        return $this->hasMany(main_menuses::class,'user_id');
    }

    public function ashya()
    {
        return $this->hasMany('App\ashya', 'user_id');
    }
    

    
    public function sponser()
    {
        return $this->hasMany('App\sponser', 'user_id');
    }

    public function office()
    {
        return $this->hasMany('App\office', 'user_id');
    }

    public function raport(){
        return $this->hasMany('App\reportFroshtn', 'user_id');
    }

    public function qestShahn()
    {
        return $this->hasMany('App\qestShahn', 'user_id');
    }

    public function amer(){
        return $this->hasMany('App\amer', 'user_id');

    }
    
    



    public function IsAdmin(){
        if($this->role->name=="administrator"){
            return true;
        }
        return false;
    }

    public function IsNormalUser(){
        if($this->role->name=="peshanga" || $this->role->name=="companya"){
            return true;
        }
        return false;
    }

  

    public static function boot() {
        parent::boot();

        static::deleting(function($user) { 
            $user->automobiles()->delete();
            $user->companies()->delete();
            $user->cities()->delete();
            $user->main_sections()->delete();
            $user->main_menus()->delete();
            $user->ashya()->delete();
            $user->sponser()->delete();
            $user->office()->delete();
            $user->report()->delete();
            $user->qestShahn()->delete();
            $user->amer()->delete();
        });
    }
}
