<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateTypePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nom' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'Checkpassword' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de l\'utilisateur ne doit pas etre null',
            'email.required' => 'Le nom de l\'utilisateur doit avoir un email',
            'email.email' => 'Le mail de l\'utilisateur doit etre valide',
            'password.required' => 'Un mot de passe est obligatoire',
            'Checkpassword.required' => 'La confirmation du mot de passe est obligatoire'

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $slug = Str::slug($this->input('nom'));
            $builder = User::where('slug', $slug);
            if ($this->input('id') != 0){
                $user = User::find($this->input('id'));
                $builder->whereNot('id', $user->id);
            }
            if ($builder->first() != null){
                $validator->errors()->add('nom', 'l\'utilisateur existe deja');
            }
        });

        $validator->after(function ($validator) {
            $email = $this->input('email');
            $builder = User::where('email', $email);
            if ($this->input('id') != 0){
                $user = User::find($this->input('id'));
                $builder->whereNot('id', $user->id);
            }
            if ($builder->first() != null){
                $validator->errors()->add('email', 'un utilisateur la meme email');
            }
        });

        $validator->after(function ($validator) {
            if ($this->input('password') != $this->input('Checkpassword')){
                $validator->errors()->add('Checkpassword', 'Le mot de passe est sa confirmation ne sont pas identiques');
            }
        });
    }
}
