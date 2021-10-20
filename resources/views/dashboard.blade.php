@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body dashboard-body">

                    <div class="row">

                        <div class="col-3">
                            <div class="dashboard-card dashboard-card-perfil">
                                <div class="col">
                                    <div class="row justify-content-center">
                                        <i class="bi bi-person-circle fa-7x"></i>
                                    </div>
                                    <div class="row justify-content-center">
                                        <h5>PERFIL</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="dashboard-card dashboard-card-projetos">
                                <div class="col">
                                    <div class="row justify-content-center">
                                        <i class="bi bi-clipboard-check"></i>
                                    </div>
                                    <div class="row justify-content-center">
                                        <h5>PROJETOS</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="dashboard-card dashboard-card-mapas-interativos">
                                <div class="col">
                                    <div class="row justify-content-center">
                                        <i class="bi bi-map"></i>
                                    </div>
                                    <div class="row justify-content-center">
                                        <h5>MAPAS INTERATIVOS</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="dashboard-card dashboard-card-consumo-dados">
                                <div class="col">
                                    <div class="row justify-content-center">
                                        <i class="bi bi-speedometer"></i>
                                    </div>
                                    <div class="row justify-content-center">
                                        <h5>CONSUMO DE DADOS</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
