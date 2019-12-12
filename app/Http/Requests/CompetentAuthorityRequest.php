<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class CompetentAuthorityRequest extends FormRequest
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
			return [
				'name'           => 'required|unique:comptent_authorities,name',
				'designation_id' => 'required|exists:designations,id',
			];
		}
		
		public function messages()
		{
			return [
				'name.unique' => 'This officer already exists in the database'
			];
		}
	}
