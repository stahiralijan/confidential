<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\Charge
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EnquiryDetail[] $enquiryDetails
 * @property-read int|null $enquiry_details_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Charge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Charge extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'name',
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
	
		public function enquiryDetails()
		{
			return $this->hasManyThrough(EnquiryDetail::class,EnquirydetailCharge::class, 'charge_id','id', 'id','enquiry_detail_id');
		}
	
		public function enquiry_cases()
		{
			return $this->hasMany(EnquiryCase::class, 'charges_id');
		}
	}
