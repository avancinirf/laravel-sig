<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArquivoController extends Controller
{
    public function __construct(Arquivo $arquivo) {
        $this->arquivo = $arquivo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arquivos = $this->arquivo->orderBy('nome')->paginate(10);
        return view('app.arquivo.index', ['arquivos' => $arquivos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nomesProjetos = (new Projeto())->getNomesProjetos();
        return view('app.arquivo.create', ['projetos' => $nomesProjetos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->arquivo->rules(), $this->arquivo->feedback());

        $file = $request->file('file');
        $file_urn = $file->store("projeto/$request->projeto_id");

        $arquivo = $this->arquivo->create([
            'projeto_id' => $request->projeto_id,
            'nome' => $request->nome,
            'nome_original' => $file->getClientOriginalName(),
            'descricao' => $request->descricao,
            'tipo' => $request->tipo,
            'file' => $file_urn
        ]);

        return redirect()->route('arquivo.show', $arquivo->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Insteger $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arquivo = $this->arquivo->with('projeto')->find($id);

        if ($arquivo === null) {
            return view('app.arquivo.show');
        }
        return view('app.arquivo.show', ['arquivo' => $arquivo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Insteger $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arquivo = $this->arquivo->with('projeto')->find($id);

        if (!$arquivo) {
            return view('app.arquivo');
        }

        return view('app.arquivo.edit', ['arquivo' => $arquivo]);
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
        $arquivo = $this->arquivo->find($id);
        if ( !$arquivo ) {
            return view('app.arquivo');
        }

        if ($request->method() === 'PATCH') {
            $dynamicRules = [];
            foreach ($arquivo->rules() as $input => $rule) {
                if (array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }
            $request->validate($dynamicRules, $arquivo->feedback());
        } else {
            $request->validate($arquivo->rules(), $arquivo->feedback());
        }

        $arquivo->fill($request->all());
        $arquivo->save();

        return redirect()->route('arquivo.show', ['arquivo' => $arquivo->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arquivo = $this->arquivo->find($id);
        if ($arquivo === null) {
            return redirect()->route('arquivo.index');
        }
        Storage::disk('local')->delete("/app/$arquivo->arquivo");

        $arquivo->delete();
        return redirect()->route('arquivo.index');
    }


    /**
     * Download de arquivos
     */
    public function download($id)
    {
        $arquivo = $this->arquivo->find($id);
        $projeto = Projeto::find($arquivo->projeto_id);

        if (auth()->user()->admin || auth()->user()->id == $projeto->user_id) {
            $path = storage_path("/app/$arquivo->file");
            return response()->download($path, $arquivo->nome_original);
        }
    }
}
