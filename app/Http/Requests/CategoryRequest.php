<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
    return [
			'name' => 'required|string|max:255',
			'description' => 'required',
			'image' => 'required|image|mimes:jpg,png,jpeg|max:1024'
    ];

  }

	public function messages()
  {
    return [
			'name.required' => 'Veuillez renseigner un nom de catégorie',
			'name.string' => 'Ce champs doit être une chaine de caractères',
			'name.max' => 'Ce champs ne peut dépasser les 255 caractères',

			'description.required' => 'Veuillez renseigner une description',

			'image.required' => 'Veuillez renseigner une illustration',
			'image.image' => 'Vous pouvez uniquement téléverser des images',
			'image.mimes' => 'L\'image doit être au format JPG/JPEG/PNG',
			'image.max' => 'La poids de l\'image ne doit pas dépasser 1Mo'
    ];
  }
}
