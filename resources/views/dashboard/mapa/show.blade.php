@extends('layouts.app')

@section('content')

    <!-- Leaflet -->
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />
    <script src="{{ asset('js/leaflet.js') }}"></script>

    <!-- Lib Leaflet para exibir .kml -->
    <!-- https://github.com/mapbox/leaflet-omnivore -->
    <script src="{{ asset('js/leaflet-omnivore.min.js') }}"></script>

    <!-- CSS Mapa -->
    <link rel="stylesheet" href="{{ asset('css/mapa.css') }}" />



    <div class="mt-0" id="mapa">
        <!-- BTN MENU LATERAL -->
        <nav class="navbar navbar-light nav-menu-mapa shadow">
            <button class="navbar-toggler btn-menu-mapa" type="button" data-toggle="modal" data-target="#modal-menu-mapa">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>


    <!-- Modal Menu-->
    <div class="modal left fade" id="modal-menu-mapa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $projeto->nome }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-menu-mapa-body" class="modal-body">
                    <label class="modal-menu-mapa-body-subtitulo"><b>DADOS DO PROJETO</b></label>
                    <label class="modal-menu-mapa-body-label"><b>NOME:</b> {{ $projeto->nome }} </label>
                    <label class="modal-menu-mapa-body-label"><b>DESCRIÇÃO:</b> {{ $projeto->descricao }}</label>
                    @if($projeto->iniciado_em || $projeto->finalizado_em)
                    <label class="modal-menu-mapa-body-label"><b>INICIADO EM:</b> {{ $projeto->iniciado_em->format('d/m/Y') }} </label>
                    <label class="modal-menu-mapa-body-label"><b>FINALIZADO EM:</b> {{ $projeto->finalizado_em->format('d/m/Y') }} </label>
                    @endif
                    <label class="modal-menu-mapa-body-label"><b>ÚLTIMA ATUALIZAÇÃO:</b> {{ $projeto->updated_at->format('d/m/Y') }} </label>

                    <br><br>
                    @if(count($projeto->arquivos) > 0)
                        <label class="modal-menu-mapa-body-subtitulo"><b>ARQUIVOS RELACIONADOS</b></label>
                        <ul class="modal-map-menu-list">
                            @foreach($projeto->arquivos as $arquivo)
                                <a href="/app/arquivo/download/{{$arquivo->id}}"><li><i class="bi bi-box-arrow-down"></i> {{$arquivo->nome}} </li></a>
                            @endforeach
                        </ul>
                    @endif
                    @if(count($projeto->geometrias) > 0)
                        <label class="modal-menu-mapa-body-subtitulo"><b>GEOMETRIAS RELACIONADOS</b></label>
                        <ul class="modal-map-menu-list">
                            @foreach($projeto->geometrias as $geometria)
                                <a href="/app/GEOMETRIA/download/{{$geometria->id}}"><li><i class="bi bi-box-arrow-down"></i> {{$geometria->nome}} </li></a>
                            @endforeach
                        </ul>
                    @endif
                    <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM Modal Menu-->


    <!-- Modal Informações do Layer -->
    <div class="modal fade" id="modal-layer-mapa" tabindex="-1" aria-labelledby="modal-layer-mapa" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-layer-mapa-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-layer-mapa-body">
                ...
                </div>
            </div>
        </div>
    </div>
    <!-- FIM Modal Informações do Layer -->


    <!--<script>
        var storagePath = "{{ route('geometria.download', 1) }}"; // updated and tested
    </script>-->
    <script>
        var projeto = <?php echo json_encode($projeto); ?>;
    </script>

    <!-- JS Mapa -->
    <script src="{{ asset('js/mapa.js') }}"></script>

@endsection
