<?php

namespace App\Http\Requests;

use App\Models\cinema\Cinema;
use App\Models\client\Client;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class ClientPostRequest extends FormRequest
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
            'type_client' => ['required', 'exists:types_clients,id'],
            'email' => ['required', 'email']
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du client ne doit pas etre null',
            'type_client.required' => 'Le client doit avoir un type',
            'email.required' => 'Le client doit avoir un mail',
            'email.email' => 'Le client doit avoir un mail valide'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $client = Client::find($this->input('id'));
            $tab_list = ($this->all());
            $tab_list_cinema = Cinema::whereNot('client_id', $client->id)->select('slug')
            ->get()->pluck('slug')->all(); // recuparation de la liste des slugs des cinema
            foreach ($tab_list as $element => $valueElement){
                if (str_contains( $element , 'cine')){ // pour chaque nouveau cinema, je verifie si le slug existe deja
                    $slugCine = Str::slug($this->input($element));

                    if ($slugCine == ""){
                        $validator->errors()->add('cinemaError', 'Le nom du cinema ne doit pas null');
                    } else {
                        if (in_array( $slugCine , $tab_list_cinema )){
                            $validator->errors()->add('cinemaError', 'Le cinema existe deja');
                        } else {
                            $tab_list_cinema [] = $slugCine;
                        }
                    }
                } else if (str_contains( $element , 'salle')){
                    if ($valueElement == ""){
                        $validator->errors()->add('cinemaError', 'Le nom de la salle ne doit pas etre null');
                    }
                }
            }
        });
    }

}
