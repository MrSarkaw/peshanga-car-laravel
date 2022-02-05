<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\main_sections;
use App\cities;
use App\companies;
class automobiles extends Model
{
    //
    protected $fillable=['menu','sec_id','name','model','plate_number','price',
                           'images','mobile_number','note','comp_id','user_id','city_name'];
    protected $primaryKey='auto_id';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function main_sections()
    {
        return $this->belongsTo(main_sections::class, 'sec_id');
    }
    public function companies()
    {
        return $this->belongsTo('App\companies', 'comp_id');
    }

   
}


