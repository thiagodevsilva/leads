<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Leads;
use App\Models\Address;

class LeadsController extends Controller
{
    public function store(Request $request)
    {
        // regras de validação
        $regras = [
            'nome' => 'required|min:3|max:255',
            'telefone' => 'required|min:3|max:2700',
            'email' => 'required|email|max:255|unique:leads',
            'cep' => 'required|min:3|max:9',
            'numero' => 'required',
            'logr' => 'required',
        ];

        $feedback = [
            'nome.required' => 'Nome obrigatório',
            'telefone.required' => 'Telefone obrigatório',
            'numero.required' => 'Número obrigatório',
            'email.required' => 'E-mail obrigatório',
            'logr.required' => 'Endereço obrigatório',
            'email.unique' => "E-mail já utilizado, use um novo endereço ou entre em contato com 'staff@lds.com'",
            'cep.required' => 'Entre com um CEP válido',
            'cep.min' => 'Entre com um CEP válido',
            'cep.max' => 'CEP inválido',
            'nome.min' => 'Nome inválido',
            'nome.max' => 'Máximo 255 caracteres',
            'email.max' => 'Máximo 255 caracteres',
        ];

        $validator = Validator::make($request->all(), $regras, $feedback);

        $validator->after(function ($validator) use ($request) {
            if ($request->rua == 'undefined') {
                $validator->errors()->add('rua', 'CEP não encontrado');
            }
        });

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Pegue os campos do request primeiro
        $addressData = [
            'cep' => $request->cep,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            // adiciona mais campos conforme necessário
        ];
    
        // Crie um novo endereço e obtenha o ID
        $address = Address::create($addressData);
        
        $lastLead = Leads::orderBy('created_at', 'desc')->first();
        $user_id = ($lastLead && $lastLead->user_id == 2) ? 3 : 2;
    
        // Agora, crie um novo lead com o ID do endereço
        $leadData = [
            'name' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'address_id' => $address->id,
            'user_id' => $user_id,
        ];
    
        Leads::create($leadData);
        
        return redirect()->route('home')->with('successo', true);

    }
}
