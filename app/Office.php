<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\Office
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Employee[] $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Office whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Office extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'id',
			'name',
			'code',
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
		 * Get the Employees for the Office.
		 */
		public function employees()
		{
			return $this->hasMany(EnquiryCase::class, 'office_id', 'id');
		}
		
	}