<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'enq_number', 'status_id'
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
     * Get the EnquiryDetails for the Enquiry.
     */
    public function enquiryDetails()
    {
        return $this->hasMany(\App\EnquiryDetail::class);
    }


    /**
     * Get the EnquiryCommittees for the Enquiry.
     */
    public function enquiryCommittees()
    {
        return $this->hasMany(\App\EnquiryCommittee::class);
    }


    /**
     * Get the ActionTakens for the Enquiry.
     */
    public function actionTakens()
    {
        return $this->hasMany(\App\ActionTaken::class);
    }


    /**
     * Get the Status for the Enquiry.
     */
    public function status()
    {
        return $this->belongsTo(\App\Status::class);
    }

}