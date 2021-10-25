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
                    <div class="card-header"><h4><b>Adicionar geometria</b></h4></div>

                    <div class="card-body">
                        <form method="post" action="{{ route('geometria.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Projeto</label>
                                <select class="form-control form-control-sm" name="projeto_id" id="projeto_id">
                                    <option value="" selected disabled>Selecione um projeto</option>
                                    @foreach ($projetos as $projeto)
                                    <option value="{{ $projeto->id }}" {{ old('projeto_id') == $projeto->id ? "selected" : "" }}>{{ $projeto->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control form-control-sm" name="nome" id="nome" value="{{ old('nome') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Descrição</label>
                                <textarea class="form-control form-control-sm" name="descricao" id="descricao" rows="3">{{ old('descricao') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tipo</label>
                                <select class="form-control form-control-sm" name="tipo" id="tipo">
                                    <option value="" selected disabled>Selecione um tipo</option>
                                    <option value="kml" {{old('tipo') == "kml" ? "selected" : ""}}>KML</option>
                                    <option value="shapefile" {{old('tipo') == "shapefile" ? "selected" : ""}}>Shapefile (.zip)</option>
                                    <option value="geojson" {{old('tipo') == "geojson" ? "selected" : ""}}>Geojson</option>
                                    <option value="csv" {{old('tipo') == "csv" ? "selected" : ""}}>CSV</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Arquivo</label>
                                <input type="file" class="form-control form-control-sm" name="file" id="file" value="{{old('file')}}">
                            </div>

                            <div class="form-group">
                                <label for="geometria_arquivos">Selecione os arquivos para associar a esta geometria</label>
                                <select multiple class="form-control" id="geometria_arquivos" name="geometria_arquivos[]">
                                </select>
                            </div>

                            </br>
                            <a href="{{ route('geometria.index') }}" class="btn btn-sm px-3 btn-primary">Lista de geometrias</a>
                            <button type="submit" class="btn btn-sm px-3 btn-success float-right">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ( old('projeto_id') )
    <script>
        var old_projeto_id = <?php echo json_encode(old('projeto_id')); ?>;
    </script>
    @endif
    @if ( old('geometria_arquivos') )
    <script>
        var old_geometria_arquivos = <?php echo json_encode(old('geometria_arquivos')); ?>;
    </script>
    @endif

    <!-- JS Mapa -->
    <script src="{{ asset('js/geometria.js') }}"></script>

@endsection
