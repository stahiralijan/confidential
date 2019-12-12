<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class DesignationFormRequest extends FormRequest
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
						'name' => 'required|string|unique:designations,name',
						'bps'            => 'numeric|max:20,min:5',
					];
				
				case 'put':
				case 'PUT':
					return [
						'designation_id' => 'exists:designations,id',
						'name'           => 'required|string',
						'bps'            => 'numeric|max:20,min:5',
					];
			}
			return [];
		}
	}
