<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class ashya extends Model
{
    protected $primaryKey="ashya_id";
    protected $fillable=['ashya_name','image','address','phone_number','user_id','car'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
