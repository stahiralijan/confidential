<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	/**
 * App\Penalty
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $penalty_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ActionTaken[] $actionTakens
 * @property-read int|null $action_takens_count
 * @property-read \App\PenaltyType|null $penaltyType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty wherePenaltyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Penalty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Penalty extends Model
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
			'penalty_type_id',
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
		 * Get the ActionTakens for the Penalty.
		 */
		public function actionTakens()
		{
			return $this->hasMany(\App\ActionTaken::class);
		}
		
		/**
		 * Get the PenaltyType for the Penalty.
		 */
		public function penaltyType()
		{
			return $this->belongsTo(\App\PenaltyType::class);
		}
		
	}