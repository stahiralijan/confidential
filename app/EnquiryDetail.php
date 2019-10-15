<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\EnquiryDetail
 *
 * @property int $id
 * @property int|null $enquiry_id
 * @property int|null $employee_id
 * @property string|null $accusation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActionTaken[] $actionTakens
 * @property-read int|null $action_takens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Charge[] $charges
 * @property-read int|null $charges_count
 * @property-read \App\Employee|null $employee
 * @property-read \App\Enquiry|null $enquiry
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail whereAccusation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail whereEnquiryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EnquiryDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class EnquiryDetail extends Model
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
			'accusation',
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
		
		
		public function charges()
		{
			return $this->hasManyThrough(Charge::class,EnquirydetailCharge::class, 'enquiry_detail_id', 'id', 'id', 'charge_id');
		}
		
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