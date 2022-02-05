<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class office extends Model
{
    protected $fillable=['name','phone_number','address','user_id'];
    protected $primaryKey='office_id';


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
