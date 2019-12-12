<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class EnquiryCase extends Model
	{
		protected $fillable = [
			'enquiry_no',
			'employee_id',
			'designation_id',
			'office_id',
			'charges_id',
			'issue_date',
			'competent_authority_id',
			'is_finalized',
			'punishment_id',
			'imposing_authority_id',
			'remarks',
		];
		
		protected $dates = [
			'issue_date',
		];
		
		public function employee()
		{
			return $this->belongsTo(Employee::class, 'employee_id', 'id');
		}
		
		public function designation()
		{
			return $this->belongsTo(Designation::class, 'designation_id', 'id');
		}
		
		public function charges()
		{
			return $this->belongsTo(Charge::class, 'charges_id', 'id');
		}
		
		public function office()
		{
			return $this->belongsTo(Office::class, 'office_id', 'id');
		}
		
		public function competent_authority()
		{
			return $this->belongsTo(ComptentAuthority::class, 'competent_authority_id', 'id');
		}
		
		public function punishment()
		{
			return $this->belongsTo(Punishments::class);
		}
		
		public function imposing_authority()
		{
			return $this->belongsTo(ComptentAuthority::class, 'imposing_authority_id', 'id');
		}
	}
