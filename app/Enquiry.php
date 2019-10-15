<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\Enquiry
 *
 * @property int $id
 * @property string $enq_number
 * @property int|null $status_id
 * @property \Illuminate\Support\Carbon|null $opening_date
 * @property \Illuminate\Support\Carbon|null $closing_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActionTaken[] $actionTakens
 * @property-read int|null $action_takens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EnquiryCommittee[] $enquiryCommittees
 * @property-read int|null $enquiry_committees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EnquiryDetail[] $enquiryDetails
 * @property-read int|null $enquiry_details_count
 * @property-read \App\Status|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry whereClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry whereEnqNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry whereOpeningDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquiry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Enquiry extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'id',
			'enq_number',
			'status_id',
			'opening_date',
			'closing_date',
		];
		
		/**
		 * The attributes that should be mutated to dates.
		 *
		 * @var array
		 */
		protected $dates = [
			'created_at',
			'updated_at',
			'opening_date',
			'closing_date',
		];
		
		/**
		 * The attributes that should be hidden for arrays.
		 *
		 * @var array
		 */
		protected $hidden = [//
		];
		
		/**
		 * The attributes that should be cast to native types.
		 *
		 * @var array
		 */
		protected $casts = [//
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