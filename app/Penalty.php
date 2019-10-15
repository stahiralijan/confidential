<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'penalty_type_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Get the ActionTakens for the Penalty.
     */
    public function actionTakens()
    {
        return $this->hasMany(\App\ActionTaken::class);
    }


    /**
     * Get the PenaltyType for the Penalty.
     */
    public function penaltyType()
    {
        return $this->belongsTo(\App\PenaltyType::class);
    }

}