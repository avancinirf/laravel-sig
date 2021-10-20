@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header"><h4><b>Editar projeto</b></h4></div>

                    <div class="card-body">
                        @if (!isset($projeto))
                        <div class="alert alert-danger" role="alert">
                            <h4>Erro ao buscar projeto</h4>
                        </div>
                        @else
                        <form method="post" action="{{ route('projeto.update', ['projeto' => $projeto->id]) }}" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">ID</label>
                                <input type="number" class="form-control form-control-sm" name="id" id="id" value="{{ $projeto->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ $projeto->nome }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Usuário</label>
                                <select class="form-control form-control-sm" name="user_id" id="user_id">
                                <option value="" selected disabled>Selecione um usuário...</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{$usuario->id}}"
                                            {{ ($usuario->id == $projeto->user_id) ? 'selected' : ''}}
                                        >{{$usuario->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="3">{{ $projeto->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Iniciado em</label>
                                <input type="date" class="form-control" name="iniciado_em" id="iniciado_em" value="{{ $projeto->iniciado_em }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Finalizado em</label>
                                <input type="date" class="form-control" name="finalizado_em" id="finalizado_em" value="{{ $projeto->finalizado_em }}">
                            </div>
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="publico" value="0">
                                    <input class="form-check-input" type="checkbox" id="publico" name="publico" value="1" {{ ($projeto->publico == true) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Projeto público.</label>
                                </div>
                            </div>
                            </br>
                            <a href="{{ route('projeto.index') }}" class="btn btn-sm px-3 btn-primary">Lista de projetos</a>
                            <button type="submit" class="btn btn-sm px-3 btn-success float-right">Atualizar</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
