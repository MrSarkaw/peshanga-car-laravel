<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class sponser extends Model
{
    protected $primaryKey='sponser_id';
    protected $fillable=['image'];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
