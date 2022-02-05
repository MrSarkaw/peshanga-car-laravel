<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\automobiles;
class main_sections extends Model
{
    protected $primaryKey='sec_id';
    protected $fillable=['sec_name','image','user_id','menu'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function automobiles()
    {
        return $this->hasMany('App\automobiles', 'sec_id');
    }
}
