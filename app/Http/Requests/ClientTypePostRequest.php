<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Models\client\TypesClient;
use Illuminate\Foundation\Http\FormRequest;

class ClientTypePostRequest extends FormRequest
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
            'nom' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du type du client ne doit pas etre null',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $slug = Str::slug($this->input('nom'));
            if (in_array($slug, ['new', 'create', 'update', 'delete'])){ // si le slug est egal a un des routes de controle
                $validator->errors()->add('nom', 'Le nom du role est invalide');
            } else if ($this->input('id') == 0){ // si nouveau type client
                if (TypesClient::where('slug', $slug )->first() ){
                    $validator->errors()->add('nom', 'Le nom du role est deja pris');
                }
            } else { // si modification
                if (TypesClient::where('slug', $slug)->whereNot('id', $this->input('id'))->first() ){
                    $validator->errors()->add('nom', 'Le nom du role est deja pris');
                }
            }
        });
    }
}
