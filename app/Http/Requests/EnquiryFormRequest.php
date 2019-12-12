<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class EnquiryFormRequest extends FormRequest
	{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return bool
		 */
		public function authorize()
		{
			return TRUE;
		}
		
		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array
		 */
		public function rules()
		{
			switch ($this->getMethod())
			{
				case 'POST':
				case 'post':
					return [
						'enq_number'          => 'required',
						'status_id'           => 'required',
						'opening_date'        => 'required|date',
						'closing_date'        => 'date',
						'employee_id'         => 'required|array',
						'charges'             => 'required|array',
						'accusation'          => 'required|array',
						'committee_member_id' => 'required|array',
					];
				
				case 'PUT':
				case 'put':
					return [
						'enquiry_id'          => 'exists:enquiries,id',
						'status_id'           => 'required',
						'opening_date'        => 'required|date',
						'closing_date'        => 'date',
						'employee_id'         => 'required|array',
						'charges'             => 'required|array',
						'accusation'          => 'required|array',
						'committee_member_id' => 'required|array',
					];
			}
			return [
			
			];
		}
	}
