<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class ActionTakenFormRequest extends FormRequest
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
				case 'PUT':
				case 'put':
					return [
						'enquiry_id'        => 'required|exists:enquiries,id',
						'penalty_id'        => 'required|array',
						'enquiry_detail_id' => 'required|array',
						'description'       => 'array',
						'employee_id'       => 'required|array',
						'status_id'         => 'required|exists:statuses,id',
					];
			}
			return [//
			];
		}
	}
