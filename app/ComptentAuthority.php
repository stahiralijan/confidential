<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class ComptentAuthority extends Model
	{
		protected $fillable = [
			'name',
			'designation_id', // designation_id
		];
		
		public function designation()
		{
			return $this->belongsTo(Designation::class);
		}
	}
