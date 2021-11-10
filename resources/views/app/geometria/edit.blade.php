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
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi-pencil mr-3"></i> <b>Geometria: {{ $geometria->nome }}</b>
                            <a class="btn btn-sm btn-success float-right mr-2" href="{{ route('geometria.create') }}">
                                <i class="bi-plus-lg"></i>
                            </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        @if (!isset($geometria))
                        <div class="alert alert-danger" role="alert">
                            <h4>Erro ao buscar geometria</h4>
                        </div>
                        @else
                        <form method="post" action="{{ route('geometria.update', $geometria->id) }}"  enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="form-label">ID</label>
                                <input type="number" class="form-control form-control-sm" name="id" id="id" value="{{ $geometria->id }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ $geometria->nome }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Projeto</label>
                                <input type="hidden" name="projeto_id" value="{{$geometria->projeto_id}}">
                                <input type="text" class="form-control form-control-sm" value="{{ $geometria->projeto->nome }} ( ID: {{$geometria->projeto_id}} )" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="3">{{ $geometria->descricao }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tipo</label>
                                <select class="form-control form-control-sm" name="tipo" id="tipo">
                                    <option value="" {{ ($geometria->tipo == '') ? 'selected' : '' }} disabled>Selecione um tipo</option>
                                    <option value="kml" {{ ($geometria->tipo == 'kml') ? 'selected' : '' }} >KML</option>
                                    <option value="shapefile" {{ ($geometria->tipo == 'shapefile') ? 'selected' : '' }} >Shapefile</option>
                                    <option value="geojson" {{ ($geometria->tipo == 'geojson') ? 'selected' : '' }} >Geojson</option>
                                    <option value="csv" {{ ($geometria->tipo == 'csv') ? 'selected' : '' }} >CSV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Arquivo</label>
                                <input type="file" class="form-control form-control-sm" name="arquivo" id="arquivo" value="{{old('arquivo')}}">
                            </div>

                            <div class="form-group">
                                <label for="geometria_arquivos">Selecione os arquivos para esta geometria</label>
                                <select multiple class="form-control" id="geometria_arquivos" name="geometria_arquivos[]">
                                    @foreach($arquivos as $arquivo)
                                        <option value="{{$arquivo['id']}}" {{ (in_array($arquivo['id'], $geometria->arquivos->modelKeys())) ? 'selected' : '' }} >{{$arquivo['nome']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            </br>
                            <a href="{{ route('geometria.index') }}" class="btn btn-sm px-3 btn-primary">Lista de geometrias</a>
                            <button type="submit" class="btn btn-sm px-3 btn-success float-right">Atualizar</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
