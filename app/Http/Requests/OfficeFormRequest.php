<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class OfficeFormRequest extends FormRequest
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
						'name' => 'required|unique:offices,name',
						'code' => 'required|unique:offices,code',
					];
				
				case 'PUT':
				case 'put':
					return [
						'office_id' => 'exists:offices,id',
						'name'      => 'required',
						'code'      => 'required',
					];
			}
			return [];
		}
	}
