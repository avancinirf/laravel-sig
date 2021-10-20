<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\User;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{

    public function __construct(Projeto $projeto) {
        $this->projeto = $projeto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetos = $this->projeto->orderBy('nome')->paginate(10);
        return view('app.projeto.index', ['projetos' => $projetos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuariosComuns = (new User())->getUsuariosComuns();
        return view('app.projeto.create', ['usuarios' => $usuariosComuns]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->projeto->rules(), $this->projeto->feedback());

        $projeto = $this->projeto->create($request->all());

        return redirect()->route('projeto.show', ['projeto' => $projeto->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projeto = $this->projeto->with('arquivos')->find($id);

        if ($projeto === null) {
            return view('app.projeto.show');
        }
        return view('app.projeto.show', ['projeto' => $projeto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuariosComuns = (new User())->getUsuariosComuns();
        $projeto = $this->projeto->find($id);
        if (!$projeto) {
            return view('app.projeto.edit');
        }

        return view('app.projeto.edit', ['projeto' => $projeto, 'usuarios' => $usuariosComuns]);
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
        $projeto = $this->projeto->find($id);

        if ($projeto === null) {
            return view('app.projeto.edit');
        }

        $request->validate($this->projeto->rules($id), $this->projeto->feedback());
        $projeto->update($request->all());

        return redirect()->route('projeto.show', ['projeto' => $projeto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projeto = $this->projeto->find($id);
        if ($projeto === null) {
            return redirect()->route('projeto.index');
        }

        $projeto->delete();
        return redirect()->route('projeto.index');
    }
}
