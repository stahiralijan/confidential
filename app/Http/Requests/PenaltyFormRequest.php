<?php
	
	namespace App\Http\Requests;
	
	use Illuminate\Foundation\Http\FormRequest;
	
	class PenaltyFormRequest extends FormRequest
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
						'penalty_type_id' => 'exists:penalty_types,id',
						'name'            => 'required|unique:penalties,name',
						'description'     => 'string',
					];
				
				case 'put':
				case 'PUT':
					return [
						'penalty_id'      => 'required|exists:penalties,id',
						'penalty_type_id' => 'required|exists:penalty_types,id',
						'name'            => 'required',
						'description'     => 'string',
					];
			}
			return [];
		}
	}
