<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class StatusFormRequest extends FormRequest
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
				case 'post':
				case 'POST':
					return [
						'name'        => 'required|unique:statuses,name',
						'description' => 'string',
					];
				
				case 'put':
				case 'PUT':
					return [
						'status_id'   => 'exists:statuses,id',
						'name'        => 'required',
						'description' => 'string',
					];
			}
			return [//
			];
		}
	}
