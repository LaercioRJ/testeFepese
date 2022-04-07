<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cidade;

class CidadeController extends Controller
{
    public function __construct(){}

    public function getAll()
    {
        return json_encode(Cidade::all());
    }

    public function getById(Request $request, $id)
    {
        $cidade = Cidade::find($id);

        if (is_null($cidade)) {
            return response()->json(['message' => 'Cidade not found'], 404);
        } else {
            return json_encode($cidade);
        }
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'estado_id' => 'required|numeric',
			    'nome' => 'required|max:40',
            ]
        );
        
	    $cidade = new Cidade();
	    $cidade->estado_id = $request->estado_id;
	    $cidade->nome = $request->nome;

        $response = $cidade->save();
	    
        return json_encode($response);
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'estado_id' => 'required',
                'nome' => 'required',
            ]
        );
        
	    $cidade = Cidade::find($request->cidade_id);
	    $cidade->estado_id = $request->estado_id;
	    $cidade->nome = $request->nome;

        $response = $cidade->save();
	    
        return json_encode($response);
    }

    public function destroy(Request $request, $id)
    {
        $cidade = Cidade::find($id);

        if (is_null($cidade)) {
            return response()->json(['message' => 'Cidade not found'], 404);
        }

        $response = $cidade->delete();
        
        return json_encode($response);
    }

    public function getAllFromState($estado_id)
    {
        $cidades = Cidade::where('estado_id', $estado_id)->get();
        return $cidades;
    }
}
