<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class reportFroshtn extends Model
{
    protected $fillable=['raport','menu','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
