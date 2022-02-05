<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class qestShahn extends Model
{
    protected $fillable=['cars','phone_number','name','menu','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
