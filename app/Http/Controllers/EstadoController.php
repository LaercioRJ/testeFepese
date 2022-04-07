<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estado;

class EstadoController extends Controller
{
    public function __construct(){}

    public function getAll()
    {
        return json_encode(Estado::all());
    }

    public function getById(Request $request, $id)
    {
        $estado = Estado::find($id);

        if (is_null($estado)) {
            return response()->json(['message' => 'Estado not found'], 404);
        } else {
            return json_encode($estado);
        }
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nome' => 'required|max:30',
			    'sigla' => 'required|max:3',
            ]
        );
        
	    $estado = new Estado();
	    $estado->nome = $request->nome;
	    $estado->sigla = $request->sigla;

        $response = $estado->save();
	    
        return json_encode($response);
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'nome' => 'required|max:30',
			    'sigla' => 'required|max:3',
            ]
        );
        
	    $estado = Estado::find($request->estado_id);
	    $estado->nome = $request->nome;
	    $estado->sigla = $request->sigla;

        $response = $estado->save();
	    
        return json_encode($response);
    }

    public function destroy(Request $request, $id)
    {
        $estado = Estado::find($id);

        if (is_null($estado)) {
            return response()->json(['message' => 'Estado not found'], 404);
        }

        $response = $estado->delete();
        
        return json_encode($response);
    }
}
