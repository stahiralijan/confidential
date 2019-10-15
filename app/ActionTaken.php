<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\ActionTaken
 *
 * @property int $id
 * @property int|null $enquiry_id
 * @property int|null $enquiry_detail_id
 * @property int|null $employee_id
 * @property int|null $penalty_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Employee|null $employee
 * @property-read \App\Enquiry|null $enquiry
 * @property-read \App\EnquiryDetail|null $enquiryDetail
 * @property-read \App\Penalty|null $penalty
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken whereEnquiryDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken whereEnquiryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken wherePenaltyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActionTaken whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ActionTaken extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'id',
			'enquiry_id',
			'enquiry_detail_id',
			'employee_id',
			'penalty_id',
			'description',
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