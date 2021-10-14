<?php

namespace App\Http\Controllers;

use App\Models\Geometria;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeometriaController extends Controller
{
    public function __construct(Geometria $geometria) {
        $this->geometria = $geometria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geometrias = $this->geometria->orderBy('nome')->paginate(10);
        return view('app.geometria.index', ['geometrias' => $geometrias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nomesProjetos = (new Projeto())->getNomesProjetos();
        return view('app.geometria.create', ['projetos' => $nomesProjetos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->geometria->rules(), $this->geometria->feedback());

        $file = $request->file('arquivo');
        $file_urn = $file->store("projeto/$request->projeto_id/geometrias");

        $geometria = $this->geometria->create([
            'projeto_id' => $request->projeto_id,
            'nome' => $file->getClientOriginalName(),
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'opcoes' => $request->opcoes,
            'arquivo' => $file_urn
        ]);

        return redirect()->route('geometria.show', $geometria->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $geometria = $this->geometria->with('projeto')->find($id);

        if ($geometria === null) {
            return view('app.geometria.show');
        }
        return view('app.geometria.show', ['geometria' => $geometria]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $geometria = $this->geometria->with('projeto')->find($id);

        if (!$geometria) {
            return view('app.geometria');
        }

        return view('app.geometria.edit', ['geometria' => $geometria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $geometria = $this->geometria->find($id);
        if ( !$geometria ) {
            return view('app.geometria');
        }

        if ($request->method() === 'PATCH') {
            $dynamicRules = [];
            foreach ($geometria->rules() as $input => $rule) {
                if (array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }
            $request->validate($dynamicRules, $geometria->feedback());
        } else {
            $request->validate($geometria->rules(), $geometria->feedback());
        }

        if ($request->file('arquivo')) {
            Storage::disk('local')->delete("/$geometria->arquivo");
            $file     = $request->file('arquivo');
            $projeto_id  = $request->projeto_id ?? $geometria->project_id;
            $file_urn = $file->store("projeto/$request->projeto_id/geometrias");

        } else {
            $file_urn = $geometria->arquivo;
        }

        $geometria->fill($request->all());
        $geometria->arquivo = $file_urn;
        $geometria->save();

        return redirect()->route('geometria.show', $geometria->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $geometria = $this->geometria->find($id);
        if ($geometria === null) {
            dd('teste');
            return redirect()->route('geometria.index');
        }
        Storage::disk('local')->delete("/app/$geometria->arquivo");

        $geometria->delete();
        return redirect()->route('geometria.index');
    }

    /**
     * Download de arquivos geométricos
     */
    public function download($id)
    {
        $geometria = $this->geometria->find($id);
        $projeto = Projeto::find($geometria->projeto_id);

        if (auth()->user()->admin || auth()->user()->id == $projeto->user_id) {
            $path = storage_path("/app/$geometria->arquivo");
            return response()->download($path, $geometria->nome);
        }
    }

}
