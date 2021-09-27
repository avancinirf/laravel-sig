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
                    <div class="card-header"><h4><b>Editar arquivo</b></h4></div>

                    <div class="card-body">
                        @if (!isset($arquivo))
                        <div class="alert alert-danger" role="alert">
                            <h4>Erro ao buscar arquivo</h4>
                        </div>
                        @else
                        <form method="post" action="{{ route('arquivo.update', ['arquivo' => $arquivo->id]) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="form-label">ID</label>
                                <input type="number" class="form-control form-control-sm" name="id" id="id" value="{{ $arquivo->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ $arquivo->nome }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Projeto</label>
                                <input type="hidden" name="projeto_id" value="{{$arquivo->projeto_id}}">
                                <input type="text" class="form-control form-control-sm" value="{{ $arquivo->projeto->nome }} ( ID: {{$arquivo->projeto_id}} )" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="3">{{ $arquivo->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tipo</label>
                                <select class="form-control form-control-sm" name="tipo" id="tipo">
                                    <option value="" {{ ($arquivo->tipo == '') ? 'selected' : '' }} disabled>Selecione um tipo</option>
                                    <option value="documento" {{ ($arquivo->tipo == 'documento') ? 'selected' : '' }} >Documento</option>
                                    <option value="imagem" {{ ($arquivo->tipo == 'imagem') ? 'selected' : '' }} >Imagem</option>
                                    <option value="imagem360" {{ ($arquivo->tipo == 'imagem360') ? 'selected' : '' }} >Imagem 360</option>
                                    <option value="geometria" {{ ($arquivo->tipo == 'geometria') ? 'selected' : '' }} >Geometria (.kml)</option>
                                    <option value="shapefile" {{ ($arquivo->tipo == 'shapefile') ? 'selected' : '' }} >Shapefile (.zip)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Arquivo</label>
                                <input type="file" class="form-control form-control-sm" name="arquivo" id="arquivo" value="{{old('arquivo')}}">
                            </div>

                            </br>
                            <a href="{{ route('arquivo.index') }}" class="btn btn-sm px-3 btn-primary">Lista de arquivos</a>
                            <button type="submit" class="btn btn-sm px-3 btn-success float-right">Atualizar</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
