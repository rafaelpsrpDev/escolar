<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Usuario;
use App\Atividade;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Curso::all();
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
        $curso = new Curso();
        
        $curso->nome = $request->nome;
        $curso->setor = $request->setor;
        $curso->duracao = $request->duracao;

        if($curso->save()) {
            return response()->json(['sucesso' => 'Curso foi criado com sucesso'], 201);
        }

        return response()->json(['erro' => 'erro ao criar o curso'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::find($id);

        return $curso ? response()->json($curso, 302)
            : response()->json(['erro' => 'recurso nao encontrado'], 404) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
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
        $data = $request->only(['nome', 'setor', 'duracao']);
        $curso = Curso::where('id', $id)->update($data);

        if($curso) {
            return response()->json(["sucess" => "Curso atualizado com sucesso"], 201);
        }

        return reponse()->json(["erro" => "Erro ao deletar o curso"], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $curso = Curso::find($id);
        
        $usuario = Usuario::where('curso_id', $id)->first();

        if($usuario) {
            return response()->json(['erro' => 'recurso em uso em usuario'], 409);
        } else {

            if($curso->delete()) {
                return response()->json(['response' => 'deletado com sucesso'], 204);
            }
        
            return response()->json(['Nao foi possivel deletar o recurso'], 204);

        }
    }

}
