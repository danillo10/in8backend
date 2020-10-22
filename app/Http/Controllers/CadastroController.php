<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Cadastro;

class CadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cadastro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $email = Cadastro::where('email',$request->email)->get();

        if(count($email) > 0){
            return response()->json(['status'=>1, 'mensagem'=>'Endereço de e-mail já cadastrado!']);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|unique:cadastros',
            'data_nascimento' => 'required',
            'telefone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>1, 'mensagem'=>'Todos os campos são obrigatórios!']);
        }

        return Cadastro::create($request->all());

    }

}
