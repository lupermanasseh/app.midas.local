<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targetsr extends Model
{
    //
     //Each saving belongs to a user
     public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Target saving
     */
    
    public function targetsavings(){
        return $this->hasMany(TargetSaving::class);
    }
    protected $dates = ['created_at', 'updated_at','review_date'];

}
