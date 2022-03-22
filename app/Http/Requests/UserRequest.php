<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'firstName' => 'string|min:2|max:100',
			'lastName' => 'string|min:2|max:100',
			'email' => 'email',
			'phone' => 'string|max:10'
		];

		return $rules;
	}

	public function messages()
	{
		return [
			'firstName.string' => 'Votre prénom doit être une chaine de caractères',
			'firstName.min' => 'Votre prénom doit faire au moins 2 caractères',
			'firstName.max' => 'Votre prénom ne peut dépasser les 100 caractères',

			'lastName.string' => 'Votre prénom doit être une chaine de caractères',
			'lastName.min' => 'Votre prénom doit faire au moins 2 caractères',
			'lastName.max' => 'Votre prénom ne peut dépasser les 100 caractères',

			'email.email' => 'Vous devez renseigner une adresse email valide',
			'email.unique' => 'Il existe déja un compte avec cette adresse mail',
		];
		}
}
