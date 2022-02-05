<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\cities;
use App\main_sections;
class amer extends Model
{
    protected $fillable=['name','sec_id','user_id','images','city_id','price','note'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function cities()
    {
        return $this->belongsTo('App\cities', 'city_id');
    }
    public function main_sections()
    {
        return $this->belongsTo('App\main_sections', 'sec_id');
    }

}
