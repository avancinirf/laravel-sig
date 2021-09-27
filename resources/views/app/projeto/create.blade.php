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
                    <div class="card-header"><h4><b>Adicionar novo projeto</b></h4></div>

                    <div class="card-body">
                        <form method="post" action="{{ route('projeto.store') }}" >
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{old('nome')}}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Usuário</label>
                                <select class="form-control form-control-sm" name="user_id" id="user_id">
                                    <option value="" selected disabled>Selecione um usuário...</option>
                                    @foreach ($usuarios as $usuario)
                                    <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Iniciado em</label>
                                <input type="date" class="form-control" name="iniciado_em" id="iniciado_em" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Finalizado em</label>
                                <input type="date" class="form-control" name="finalizado_em" id="finalizado_em" >
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="publico" name="publico" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Projeto Público
                                    </label>
                                </div>
                            </div>
                            </br>
                            <a href="{{ route('projeto.index') }}" class="btn btn-sm px-3 btn-primary">Lista de projetos</a>
                            <button type="submit" class="btn btn-sm px-3 btn-success float-right">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
