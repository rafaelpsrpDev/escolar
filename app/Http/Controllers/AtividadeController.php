<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Curso;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Atividade::all();
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
        $atividade = new Atividade();

        //dd($request->curso_id);

        $curso = Curso::find($request->curso_id);

        $atividade->nome = $request->nome;
        $atividade->valor = $request->valor;
        $atividade->curso_id = $request->curso_id;  

        if(is_null($curso)) {
                return response()->json(['erro' => 'Curso nao foi encontrado'], 409);
        }else {

            if ($atividade->save()) {
                return response()->json(['sucesso' => 'Atividade cadastrada com sucesso'], 201);
            }

            return response()->json(['erro' => 'Erro ao cadastrar a atividade'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        $atividade = Atividade::find($id);

        return $atividade ?  response()->json($atividade, 302)
            : response()->json(['erro' => 'nao foi possivel encontrar o erro'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atividade  $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit(Atividade $atividade)
    {

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
        $data = $request->only(['nome', 'valor', 'curso_id']);

        $atividade = Atividade::where('id', $id)->update($data);

        $curso = Curso::find($data['curso_id']);

        //dd($curso);
        if(is_null($curso)) {

            return response()->json(['erro' => 'Curso nao foi encontrado'], 409);
        
        }else {

            if ($atividade) {

                return response()->json(['sucesso' => 'Atividade atualizada com sucesso'], 201);
            }

            return response()->json(['erro' => 'Não foi possivel atualizar a atividade'], 400);
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
        $atividade = Atividade::find($id);

        if($atividade->delete()) {
        
            return response()->json(['sucesso' => 'Atividade excluida com sucesso'], 204);
        }

        return response()->json(['erro' => 'Nao foi possivel excluir a atividade'], 404);
    }
}
