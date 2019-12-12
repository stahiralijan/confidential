<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Contracts\Validation\Rule;
	use Illuminate\Foundation\Http\FormRequest;
	
	class EmployeeFormRequest extends FormRequest
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
						'fullname'      => 'required',
						'fathername'    => '',
						'cnic'          => '',
						'employee_code' => '',
						'mobile_number' => '',
					];
				
				case 'PUT':
				case 'put':
					return [
						'employee_id'   => 'exists:employees,id',
						'fullname'      => 'required',
						'fathername'    => '',
						'cnic'          => '',
						'employee_code' => '',
						'mobile_number' => '',
					];
			}
			return [];
		}
	}
