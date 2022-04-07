<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PessoaFisica;

class PessoaFisicaController extends Controller
{
   
    public function __construct(){}

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nome' => 'required|max:40',
			    'cpf' => 'required|numeric',
			    'endereco' => 'required|max:50',
			    'cidade_id' => 'required|numeric',
			    'estado_id' => 'required|numeric',
            ]
        );
        
	    $pessoa = new PessoaFisica();
	    $pessoa->nome = $request->nome;
	    $pessoa->cpf = $request->cpf;
	    $pessoa->endereco = $request->endereco;
	    $pessoa->cidade_id = $request->cidade_id;
	    $pessoa->estado_id = $request->estado_id;

        $pessoa->save();

        return $pessoa->id;
    }
    
    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => 'required|numeric',
                'nome' => 'required|max:40',
			    'cpf' => 'required|numeric',
			    'endereco' => 'required|max:50',
			    'cidade_id' => 'required|numeric',
			    'estado_id' => 'required|numeric',
            ]
        );
        
	    $pessoa = PessoaFisica::find($request->id);

        if (is_null($pessoa)) {
            return response()->json(['message' => 'Pessoa Fisica not found'], 404);
        }

	    $pessoa->nome = $request->nome;
	    $pessoa->cpf = $request->cpf;
	    $pessoa->endereco = $request->endereco;
	    $pessoa->cidade_id = $request->cidade_id;
	    $pessoa->estado_id = $request->estado_id;
	    
        return json_encode(PessoaFisica::updatePessoaFisica($pessoa));
    }

    public function index(Request $request)
    {
    	$this->validate(
            $request,
            [
                'nome' => 'nullable'
            ]
        );
        
        if(null != $request->nome){
        	$result = PessoaFisica::where('nome', $request->nome)->orderBy('nome')->get();
        	return json_encode($result);
        }
        
        return json_encode(PessoaFisica::orderBy('nome')->get());
    }

    public function show(Request $request, $id)
    {
        $pessoa = PessoaFisica::find($id);

        if (is_null($pessoa)) {
            return response()->json(['message' => 'Pessoa Fisica not found'], 404);
        } else {
            return json_encode($pessoa);
        }
    }


    public function destroy(Request $request, $id)
    {
        $pessoa = PessoaFisica::find($id);

        if (is_null($pessoa)) {
            return response()->json(['message' => 'Pessoa Fisica not found'], 404);
        }
	    
        return json_encode(PessoaFisica::deletePessoaFisica($pessoa));
    }

    public function findByCpf(Request $request, $cpf)
    {

        $pessoa = PessoaFisica::where('cpf', $cpf)->get();

        if (count($pessoa) == 0) {
            return response()->json(['message' => 'Pessoa Fisica not found'], 404);
        } else {
            return json_encode($pessoa);
        }
    }

}
