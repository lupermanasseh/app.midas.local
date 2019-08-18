<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targetsr extends Model
{
    //
    protected $fillable = [
        'user_id', 
        'amount_saved', 
        'entry_date',
        'notes',
        'created_by',
    ];
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
