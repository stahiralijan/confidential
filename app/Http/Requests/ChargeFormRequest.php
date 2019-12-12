<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class ChargeFormRequest extends FormRequest
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
						'name'        => 'required|unique:charges,name',
						'description' => 'string',
					];
				
				case 'PUT':
				case 'put':
					return [
						'charge_id'   => 'exists:charges,id',
						'name'        => 'required',
						'description' => 'string',
					];
			}
			return [//
			];
		}
	}
