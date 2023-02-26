<?php

namespace App\Http\Requests;

use App\Models\user\Role;
use Illuminate\Support\Str;
use App\Models\cinema\Cinema;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RolePostRequest extends FormRequest
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

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du role ne doit pas etre null',
            'is_admin.required' => 'Le champ admin ne doit pas etre null',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $cinema = Cinema::getCinemaSlug($this->route()->cinema);
            $slug = Str::slug($this->input('nom'));
            if (in_array($slug, ['new', 'create', 'update', 'delete'])){ // si le slug est egal a un des routes de controle
                $validator->errors()->add('nom', 'Le nom du role est invalide');
            } else if ($this->input('id') == 0){ // si nouveau role
                if (Role::where('slug', $slug )->first() ){
                    $validator->errors()->add('nom', 'Le nom du role est deja pris');
                }
            } else { // si modification
                if (Role::where('slug', $slug)->whereNot('id', $cinema->id)->first() ){
                    $validator->errors()->add('nom', 'Le nom du role est deja pris');
                }
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nom' => ['required'],
            'is_admin' => ['required'],
        ];
    }
}
