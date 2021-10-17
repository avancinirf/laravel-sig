@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any() || !isset($geometria))
                    <div class="alert alert-danger" role="alert">
                        @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @else
                            <h4>Geometria não encontrado</h4>
                        @endif
                    </div>
                @endif
                @if (!isset($geometria))

                @else
                <div class="card">
                    <div class="card-header">
                        <h4><b>Geometria: {{ $geometria->nome }}</b>
                            <a class="btn btn-sm btn-success float-right" href="{{ route('geometria.create') }}">
                                <i class="bi-plus-lg"></i>
                            </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <fieldset disabled>
                            <div class="form-group">
                                <label class="form-label">Id</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $geometria->id }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $geometria->nome }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Projeto</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $geometria->projeto->nome }}( ID: {{$geometria->projeto_id}})">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" rows="3">{{ $geometria->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tipo</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $geometria->tipo }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Criado em</label>
                                <input type="text" class="form-control" value="{{ $geometria->created_at }}" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Atualizado em</label>
                                <input type="text" class="form-control" value="{{ $geometria->updated_at }}" >
                            </div>
                            <hr/>
                            <p>Link para download: <a href="{{route('geometria.download', $geometria->id)}}">{{$geometria->nome}}</a></p>
                            <hr/>
                            <h4>Arquivos associados</h4>
                            <ul>
                                @foreach($geometria->arquivos as $arquivo)
                                    <li><a href="{{route('arquivo.download', $arquivo->id)}}">{{$arquivo->nome}}</a></li>
                                @endforeach
                            </ul>
                            <hr/>
                        </fieldset>
                        <a href="{{ route('geometria.index') }}" class="btn btn-sm px-3 btn-primary">Lista de geometrias</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
