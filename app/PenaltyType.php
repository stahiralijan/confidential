<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\PenaltyType
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActionTaken[] $actionTakens
 * @property-read int|null $action_takens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Penalty[] $penalties
 * @property-read int|null $penalties_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PenaltyType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PenaltyType extends Model
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'id',
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
		
		/**
		 * Get the Penalties for the PenaltyType.
		 */
		public function penalties()
		{
			return $this->hasMany(\App\Penalty::class);
		}
		
		public function actionTakens()
		{
			return $this->hasManyThrough(ActionTaken::class, Penalty::class, 'penalty_type_id', 'penalty_id', 'id', 'id');
		}
	}