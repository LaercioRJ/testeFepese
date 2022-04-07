<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscricao;

class InscricaoController extends Controller
{
    public function __construct(){}

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
			    'pessoa_fisica_id' => 'required|numeric',
			    'cargo' => 'required|max:50',
			    'situacao' => 'required'
            ]
        );
        
	    $inscricao = new Inscricao();
	    $inscricao->pessoa_fisica_id = $request->pessoa_fisica_id;
	    $inscricao->cargo = $request->cargo;
	    $inscricao->situacao = $request->situacao;

        $inscricao->save();

        return $inscricao->id;
    }
    
    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
            	'id' => 'required|numeric',
			    'pessoa_fisica_id' => 'required|numeric',
			    'cargo' => 'required|max:50',
			    'situacao' => 'required',
            ]
        );
        
	    $inscricao = Inscricao::find($request->id);
	    $inscricao->pessoa_fisica_id = $request->pessoa_fisica_id;
	    $inscricao->cargo = $request->cargo;
	    $inscricao->situacao = $request->situacao;
	    
	    return json_encode(Inscricao::updateInscricao($inscricao));
    }

    public function index(Request $request)
    {
    	$this->validate(
            $request,
            [
			    'cargo' => 'nullable'
            ]
        );
        
        if(null != $request->cargo){
        	$result = Inscricao::where('cargo', $request->cargo)->orderBy('cargo')->get();
        	return json_encode($result);
        }
        
        return json_encode(Inscricao::orderBy('cargo')->get());
    }

    public function show(Request $request, $id)
    {
        $inscricao = Inscricao::find($id);

        if (is_null($inscricao)) {
            return response()->json(['message' => 'Inscricao not found'], 404);
        } else {
            return json_encode($inscricao);
        }
    }

    public function destroy(Request $request, $id)
    {
        $inscricao = Inscricao::find($id);
	    
        return json_encode(Inscricao::deleteInscricao($inscricao));
    }

    public function getByPersonIdAndPosition(Request $request)
    {
        $this->validate(
            $request,
            [
            	'pessoa_fisica_id' => 'required|numeric',
			    'cargo' => 'required|max:50',
            ]
        );

        $inscricao = Inscricao::where([
            ['pessoa_fisica_id', $request->pessoa_fisica_id],
            ['cargo', $request->cargo]])->get();


        if (is_null($inscricao)) {
            return response()->json(['message' => 'Inscricao not found'], 404);
        } else {
            return $inscricao;
        }
    }

}