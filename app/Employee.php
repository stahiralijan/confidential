<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fullname', 'cnic', 'code', 'mobile_number', 'bps', 'office_id', 'designation_id'
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
     * Get the EnquiryDetails for the Employee.
     */
    public function enquiryDetails()
    {
        return $this->hasMany(\App\EnquiryDetail::class);
    }


    /**
     * Get the EnquiryCommittees for the Employee.
     */
    public function enquiryCommittees()
    {
        return $this->hasMany(\App\EnquiryCommittee::class);
    }


    /**
     * Get the ActionTakens for the Employee.
     */
    public function actionTakens()
    {
        return $this->hasMany(\App\ActionTaken::class);
    }


    /**
     * Get the Designation for the Employee.
     */
    public function designation()
    {
        return $this->belongsTo(\App\Designation::class);
    }


    /**
     * Get the Office for the Employee.
     */
    public function office()
    {
        return $this->belongsTo(\App\Office::class);
    }

}