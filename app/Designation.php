<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\Designation
 *
 * @property int $id
 * @property string $name
 * @property string|null $bps
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Employee[] $employees
 * @property-read int|null $employees_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation whereBps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Designation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Designation extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'id',
			'name',
			'bps'
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
		
	}