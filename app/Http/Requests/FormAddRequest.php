<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormAddRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	protected function failedValidation(Validator $validator)
	{
		$res = response()->json([
			'status' => 400,
			'errors' => $validator->errors(),
		],400);
		throw new HttpResponseException($res);
	}

	protected function getValidatorInstance(): Validator
	{
		$json = $this->request->get('forms');
		$this->merge(['forms' => json_decode($json, true)]);
		return parent::getValidatorInstance();
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'forms.gender'    => 'required',
			'forms.pref'      => 'required',
			'forms.facilitys' => 'required'
		];
	}
}
