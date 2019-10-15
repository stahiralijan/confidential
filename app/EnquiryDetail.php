<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'enquiry_id', 'employee_id'
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
     * Get the ActionTakens for the EnquiryDetail.
     */
    public function actionTakens()
    {
        return $this->hasMany(\App\ActionTaken::class);
    }


    /**
     * Get the Employee for the EnquiryDetail.
     */
    public function employee()
    {
        return $this->belongsTo(\App\Employee::class);
    }


    /**
     * Get the Enquiry for the EnquiryDetail.
     */
    public function enquiry()
    {
        return $this->belongsTo(\App\Enquiry::class);
    }

}