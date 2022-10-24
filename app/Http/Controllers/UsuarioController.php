<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Curso;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Usuario::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();

        $curso = Curso::find($request->curso_id);

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->telefone = $request->telefone;
        $usuario->curso_id = $request->curso_id;

        if(is_null($curso)) {
            return response()->json(['erro' => 'nao existe esse curso para cadastrar esse usuario'], 409);
        }else {
            if($usuario->save()) {
                return response()->json(['sucesso' => 'Usuario cadastrado com sucesso'], 201);
            }
            
            return response()->json(['erro' => 'Usuario nao cadastrado'], 400);      
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        return $usuario ? response()->json($usuario, 302) 
            : response()->json(['erro' => 'Recurso nao encontrado'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['nome', 'email', 'telefone', 'curso_id']);

        $curso = Curso::find($data['curso_id']);
        
        $usuario = Usuario::where('id', $id)->update($data);

        if(is_null($curso)) {
            return response()->json(['erro' => 'nao existe esse curso para ser atualizado'], 409);
        
        }else {
            
            if($usuario) {
                return response()->json(["sucess" => "Usuario atualizado com sucesso"], 201);
            }

            return response()->json(["erro" => "Nao existe esse usuario"], 400);
    
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if($usuario->delete()) {

            return response()->json(['response' => 'deletado com sucesso'], 204);
        }
        return response()->json(['erro' => 'Nao foi possivel deletar o recurso'], 404);
    }       
}
