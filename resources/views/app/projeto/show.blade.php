@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any() || !isset($projeto))
                    <div class="alert alert-danger" role="alert">
                        @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @else
                            <h4>Projeto não encontrado</h4>
                        @endif
                    </div>
                @endif
                @if (!isset($projeto))

                @else
                <div class="card">
                    <div class="card-header">
                        <h4><b>Projeto: {{ $projeto->nome }}</b>
                            <a class="btn btn-sm btn-success float-right" href="{{ route('projeto.create') }}">
                                <i class="bi-plus-lg"></i>
                            </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <fieldset disabled>
                            <div class="form-group">
                                <label class="form-label">Id</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $projeto->id }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $projeto->nome }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Usuário</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $projeto->user_id }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" rows="3">{{ $projeto->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Iniciado em</label>
                                <input type="date" class="form-control" value="{{ $projeto->iniciado_em }}" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Finalizado em</label>
                                <input type="date" class="form-control" value="{{ $projeto->finalizado_em }}" >
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="publico" name="publico" {{ ($projeto->publico == true) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Projeto Público
                                    </label>
                                </div>
                            </div>
                            <hr/>
                            @if (count($projeto->arquivos) == 0)
                                Nenhum arquivo associado ao projeto.
                            @else
                                <h5 class="text-center">ARQUIVOS RELACIONADOS</h5>
                                <ul class="lista-show-elementos">
                                @foreach ($projeto->arquivos as $arquivo)
                                    <!--<li>( ID: {{$arquivo->id}} ) - {{$arquivo->nome}} - <a href="{{asset('storage/'.$arquivo->arquivo)}}">{{$arquivo->nome}}</a></li>-->
                                    <li><a href="{{route('arquivo.download', $arquivo->id)}}"><i class="bi bi-box-arrow-down"></i></a> {{ $arquivo->nome . '.' . explode('.', $arquivo->arquivo)[1] }}</li>
                                @endforeach
                                </ul>
                            @endif
                            <hr/>
                        </fieldset>
                        <a href="{{ route('projeto.index') }}" class="btn btn-sm px-3 btn-primary">Lista de projetos</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
