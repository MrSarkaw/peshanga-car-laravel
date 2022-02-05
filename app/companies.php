<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\automobiles;

class companies extends Model
{
    protected $primaryKey="comp_id";
    protected $fillable=['comp_name','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function automobiles()
    {
        return $this->hasMany(automobiles::class, 'comp_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($comp) { 
            $comp->automobiles()->delete();
           
             
        });
    }
    
}
