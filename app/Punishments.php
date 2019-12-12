<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Punishments extends Model
	{
		protected $table = 'punishments';
		
		protected $fillable = [
			'name',
			'punishment_detail'
		];
	}
