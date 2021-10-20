@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4><b>Meus Mapas</b></h4>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                        @foreach ($mapas as $mapa)
                            <li class="list-group-item"><a href="{{ route('show.mapa', $mapa->id) }}">{{$mapa->nome}}</a></li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
