@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any() || !isset($arquivo))
                    <div class="alert alert-danger" role="alert">
                        @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @else
                            <h4>Arquivo não encontrado</h4>
                        @endif
                    </div>
                @endif
                @if (!isset($arquivo))

                @else
                <div class="card">
                    <div class="card-header">
                        <h4><b>Arquivo: {{ $arquivo->nome }}</b>
                            <a class="btn btn-sm btn-primary float-right" href="{{ route('arquivo.edit', $arquivo->id) }}">
                                <i class="bi-pencil-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-success float-right mr-2" href="{{ route('arquivo.create') }}">
                                <i class="bi-plus-lg"></i>
                            </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <fieldset disabled>
                            <div class="form-group">
                                <label class="form-label">Id</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $arquivo->id }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Projeto</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $arquivo->projeto->nome }}( ID: {{$arquivo->projeto_id}})">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $arquivo->nome }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" rows="3">{{ $arquivo->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tipo</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $arquivo->tipo }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Criado em</label>
                                <input type="text" class="form-control" value="{{ $arquivo->created_at }}" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Atualizado em</label>
                                <input type="text" class="form-control" value="{{ $arquivo->updated_at }}" >
                            </div>
                            <hr/>
                            <p><a class="link-download-show-elementos" href="{{route('arquivo.download', $arquivo->id)}}"><i class="bi bi-box-arrow-down"></i></a>{{$arquivo->nome_original}}</p>
                            <hr/>
                        </fieldset>
                        <a href="{{ route('arquivo.index') }}" class="btn btn-sm px-3 btn-primary">Lista de arquivos</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
