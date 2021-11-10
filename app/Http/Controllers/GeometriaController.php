<?php

namespace App\Http\Controllers;

use App\Models\Geometria;
use App\Models\GeometriaArquivo;
use App\Models\Projeto;
use App\Models\Arquivo;
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
        //$arquivos = Arquivo::all();
        //return view('app.geometria.create', ['projetos' => $nomesProjetos, 'arquivos' => $arquivos]);
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

        $file     = $request->file('file');
        $file_urn = $file->store("projeto/$request->projeto_id/geometrias");

        $geometria = $this->geometria->create([
            'projeto_id'    => $request->projeto_id,
            'nome'          => $request->nome,
            'nome_original' => $file->getClientOriginalName(),
            'descricao'     => $request->descricao,
            'tipo'          => $request->tipo,
            'opcoes'        => $request->opcoes,
            'file'          => $file_urn
        ]);

        $geometria_arquivo = new GeometriaArquivo;

        if ($request->geometria_arquivos) {
            foreach ($request->geometria_arquivos as $arquivo) {
                $geometria_arquivo->create([
                    'geometria_id' => $geometria->id,
                    'arquivo_id'   => $arquivo
                ]);
            }
        }

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
        $geometria = $this->geometria->with('projeto')->with('arquivos')->find($id);
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
        $geometria = $this->geometria->with('projeto')->with('arquivos')->find($id);
        $arquivos = Arquivo::select('id', 'nome')->where('projeto_id', $geometria->projeto_id)->orderBy('nome')->get()->toarray();
        if (!$geometria) {
            return view('app.geometria');
        }
        return view('app.geometria.edit', ['geometria' => $geometria, 'arquivos' => $arquivos]);
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
        $geometria = $this->geometria->with('arquivos')->find($id);
        $arquivos_antigos = $geometria->arquivos->modelKeys();

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

        $geometria->fill($request->all());
        $geometria->save();

        $arquivos_para_remover = array_diff($arquivos_antigos, $request->geometria_arquivos);
        $arquivos_para_adicionar = array_diff($request->geometria_arquivos, $arquivos_antigos);

        foreach($arquivos_para_remover as $arquivo) {
            $geometria_arquivo = GeometriaArquivo::where('geometria_id', $id)->where('arquivo_id', $arquivo)->delete();
        }
        foreach($arquivos_para_adicionar as $arquivo) {
            $geometria_arquivo = new GeometriaArquivo;
            $geometria_arquivo->create([
                'geometria_id' => $id,
                'arquivo_id' => $arquivo
            ]);
        }

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
            $path = storage_path("/app/$geometria->file");
            return response()->download($path, $geometria->nome_original);
        }
    }

    /**
     *
     */
    public function getArquivosPorProjeto($projeto_id)
    {
        $arquivos = Arquivo::where('projeto_id', $projeto_id)->orderBy('nome')->get();
        return $arquivos;
    }

}
