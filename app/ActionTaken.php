<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionTaken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'enquiry_id', 'enquiry_detail_id', 'employee_id', 'penalty_id', 'description'
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
     * Get the Employee for the ActionTaken.
     */
    public function employee()
    {
        return $this->belongsTo(\App\Employee::class);
    }


    /**
     * Get the Enquiry for the ActionTaken.
     */
    public function enquiry()
    {
        return $this->belongsTo(\App\Enquiry::class);
    }


    /**
     * Get the EnquiryDetail for the ActionTaken.
     */
    public function enquiryDetail()
    {
        return $this->belongsTo(\App\EnquiryDetail::class);
    }


    /**
     * Get the Penalty for the ActionTaken.
     */
    public function penalty()
    {
        return $this->belongsTo(\App\Penalty::class);
    }

}