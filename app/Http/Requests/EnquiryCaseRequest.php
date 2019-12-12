<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	use Illuminate\Validation\Rule;
	
	class EnquiryCaseRequest extends FormRequest
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
			switch ($this->method())
			{
				case 'post':
				case 'POST':
					return [
						"enquiry_no"             => "required|unique:enquiry_cases,enquiry_no",
						"employee_id"            => "required|exists:employees,id",
						"designation_id"         => "required|exists:designations,id",
						"office_id"              => "required|exists:offices,id",
						"issue_date"             => "required|date",
						"competent_authority_id" => "required|exists:comptent_authorities,id",
						"charges_id"             => "required|exists:charges,id",
					];
				
				case 'put':
				case 'PUT':
					return [
						"case_id"               => "required|exists:enquiry_cases,id",
						"punishment_id"         => "required|exists:punishments,id",
						"imposing_authority_id" => "required|exists:comptent_authorities,id",
						'remarks'               => '',
					];
			}
			return [];
		}
		
		public function messages()
		{
			return [
				'enq_no.unique' => 'This enquiry already exists against the given CNIC number',
			];
		}
	}
