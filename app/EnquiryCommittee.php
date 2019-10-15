<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\EnquiryCommittee
 *
 * @property int $id
 * @property int|null $enquiry_id
 * @property int|null $employee_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Employee|null $employee
 * @property-read \App\Enquiry|null $enquiry
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee whereEnquiryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryCommittee whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class EnquiryCommittee extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'id',
			'enquiry_id',
			'employee_id',
		];
		
		/**
		 * The attributes that should be mutated to dates.
		 *
		 * @var array
		 */
		protected $dates = [
			'created_at',
			'updated_at',
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
		 * Get the Employee for the EnquiryCommittee.
		 */
		public function employee()
		{
			return $this->belongsTo(\App\Employee::class);
		}
		
		
		/**
		 * Get the Enquiry for the EnquiryCommittee.
		 */
		public function enquiry()
		{
			return $this->belongsTo(\App\Enquiry::class);
		}
		
	}