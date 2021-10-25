@extends('layouts.app')

@section('content')
    <div class="section">

        <div class="sec-1">
            <div class="row">
                <div class="sec-1-img-textbox">
                    <h1 class="sec-1-title"><strong>Geoinformação</strong> Norteando</br> Decisões Sustentáveis</h1>
                </div>
            </div>
        </div>

        <div class="sec-2">
            <div class="d-flex justify-content-between">
                <div class="col">
                    <p class="sec-2-text-1">AQUISIÇÃO E GERENCIAMENTO DE DADOS GEOGRÁFICOS PARA PLANEJAMENTO E TOMADA DE DECISÕES ESTRATÉGICAS E SUSTENTÁVEIS</p>
                </div>
                <div class="col">
                    <p class="sec-2-text-2">Nossa missão é contribuir com o desenvolvimento sustentável, fomentando a regularização fundiária e conservação ambiental através da aplicação de geotecnologias.</p>
                </div>
            </div>
        </div>

        <div class="sec-3">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col">
                    <p class="sec-3-title">AQUISIÇÃO DE DADOS GEOGRÁFICOS</p>
                    <p class="sec-3-text">Levantamento Topográfico e Geodésio.</p>
                    <p class="sec-3-text">Georreferenciamento de imóveis rurais - SIGEF</p>
                    <p class="sec-3-text">Mapeamento de uso e cobertura do solo e Cadastro Ambiental Rural - CAR</p>
                    <p class="sec-3-text">Aerolevantamento e Registros com drone</p>
                    <p class="sec-3-text">Sensoriamento Remoto e Aerofotogrametria</p>
                    <button class="sec-3-btn-saiba-mais btn btn-outline-primary mt-5">Saiba Mais</button>
                </div>
                <div class="col">
                    <img class="sec-3-img" src="img/foto_02.jpeg"/>
                </div>
            </div>
        </div>

        <div class="sec-4">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col sec-4-col-1">
                    <img class="sec-4-img img-fluid" src="img/foto_04.jpg"/>
                </div>
                <div class="col sec-4-col-2">
                    <p class="sec-4-title">GERENCIAMENTO DE DADOS GEOGRÁFICOS</p>
                    <p class="sec-4-text">Painéis de gestão de informações geográficas</p>
                    <p class="sec-4-text">Geoprocessamento</p>
                    <p class="sec-4-text">Desenvolvimento de Mapas Interativos - SIGweb</p>
                    <p class="sec-4-text">Bussiness Inteligente - BI Dashboards</p>
                    <p class="sec-4-text">Consultoria em gestão territorial e licenciamento ambiental</p>
                </div>
            </div>
        </div>


        <div class="sec-5">
            <div class="row">
                <div class="col d-flex flex-column justify-content-between">
                    <p class="sec-5-title">"Mata Atlântica te levante/ Deixa o meu peito aberto / Pra ti plantar na esperança / Pra ti mostrar pros meus netos.”</p>
                    <p class="sec-5-text">— Luis Perequê</p>
                </div>
            </div>
        </div>


        <div class="sec-6">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col sec-6-col-1">
                    <p class="sec-6-title">Vamos nos reunir na vida real para conversar na beleza do mundo natural.</p>
                </div>
                <div class="col sec-6-col-2">
                    <form>
                        <div class="form-group">
                            <p class="sec-6-text">Inscreva-se para ficar sabendo dos nossos cursos, lives e muitos mais em primeira mão.</p>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Endereço de e-mail">
                            <small id="emailHelp" class="form-text text-muted">Seu e-mail não será compartilhado com outras empresas ou serviços.</small>
                        </div>
                        <button type="submit" class="btn btn-outline-primary mt-3">Inscreva-se</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
