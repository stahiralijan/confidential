<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Query\Builder;
	
	/**
	 * App\Employee
	 *
	 * @property int                                                                   $id
	 * @property string                                                                $fullname
	 * @property string|null                                                           $cnic
	 * @property string|null                                                           $code
	 * @property string|null                                                           $mobile_number
	 * @property int|null                                                              $office_id
	 * @property int|null                                                              $designation_id
	 * @property \Illuminate\Support\Carbon|null                                       $created_at
	 * @property \Illuminate\Support\Carbon|null                                       $updated_at
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActionTaken[]      $actionTakens
	 * @property-read int|null                                                         $action_takens_count
	 * @property-read \App\Designation|null                                            $designation
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EnquiryCommittee[] $enquiryCommittees
	 * @property-read int|null                                                         $enquiry_committees_count
	 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EnquiryDetail[]    $enquiryDetails
	 * @property-read int|null                                                         $enquiry_details_count
	 * @property-read \App\Office|null                                                 $office
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee newModelQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee newQuery()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee query()
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee searchCnic($term)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee searchFullname($term)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereCnic($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereCode($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereCreatedAt($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereDesignationId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereFullname($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereMobileNumber($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereOfficeId($value)
	 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employee whereUpdatedAt($value)
	 * @mixin \Eloquent
	 */
	class Employee extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'fullname',
			'fathername',
			'employee_code',
			'cnic',
			'mobile_number',
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
		
		public function scopeSearchFullname(Builder $query, $term)
		{
			return $query->orWhere('fullname', 'like', "%{$term}%");
		}
		
		public function scopeSearchCnic(Builder $query, $term)
		{
			return $query->orWhere('cnic', 'like', "%{$term}%");
		}
	}