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


    <!--



        https://www.youtube.com/watch?v=9-is6LzhZ_Y



    -->


    <div class="mt-0" id="mapa">
        <!-- BTN MENU LATERAL -->
        <nav class="navbar navbar-light nav-menu-mapa shadow">
            <button class="navbar-toggler btn-menu-mapa" type="button" data-toggle="modal" data-target="#modal-menu-mapa">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>




    <!-- Modal -->
    <div class="modal left fade" id="modal-menu-mapa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">MENU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary btn-block" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>


    <!--<script>
        var storagePath = "{{ route('geometria.download', 1) }}"; // updated and tested
    </script>-->
    <script>
        var projeto = <?php echo json_encode($projeto); ?>;
    </script>

    <!-- JS Mapa -->
    <script src="{{ asset('js/mapa.js') }}"></script>

@endsection
