<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class roles extends Model
{
    protected $primaryKey="role_id";
    public function users()
    {
        return $this->hasMany(User::class,'role_id');
    }

   


    public static function boot(){
        parent::boot();
        static::deleting(function($role){
            $role->users()->delete();
        });
    }
}
