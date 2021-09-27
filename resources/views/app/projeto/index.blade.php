@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4><b>Gestão de projetos</b>
                            <a class="btn btn-sm btn-success float-right" href="{{ route('projeto.create') }}">
                                <i class="bi-plus-lg"></i>
                            </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Iniciado em</th>
                                    <th scope="col">Finalizado em</th>
                                    <th scope="col">Público</th>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projetos as $projeto)
                                    <tr>
                                        <th scope="row">{{ $projeto->id }}</th>
                                        <td>{{ $projeto->nome }}</td>
                                        <td>{{ $projeto->descricao }}</td>
                                        <td>
                                            @if ($projeto->iniciado_em)
                                                {{ date('d/m/Y', strtotime($projeto->iniciado_em)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($projeto->finalizado_em)
                                                {{ date('d/m/Y', strtotime($projeto->finalizado_em)) }}
                                            @endif
                                        </td>
                                        @if ($projeto->publico)
                                            <td>sim</td>
                                        @else
                                            <td>não</td>
                                        @endif
                                        <td>{{ $projeto->user_id }}</td>
                                        <td>
                                            <form id="form_{{ $projeto->id }}" method="post" action="{{ route('projeto.destroy', ['projeto' => $projeto->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <a class="btn btn-sm btn-primary" href="{{ route('projeto.show', $projeto->id) }}"><i class="bi-eye-fill"></i></a>
                                                <a class="btn btn-sm btn-primary" href="{{ route('projeto.edit', $projeto->id) }}"><i class="bi-pencil-fill"></i></a>
                                                <a class="btn btn-sm btn-danger"
                                                    onclick="confirm('Tem certeza que deseja remover o projeto {{$projeto->nome}} (ID: {{$projeto->id}})?',
                                                        document.getElementById('form_{{$projeto->id}}').submit()
                                                    )"
                                                ><i class="bi-trash-fill"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $projetos->previousPageUrl() }}">anterior</a></li>
                                @for ( $i = 1; $i <= $projetos->lastPage(); $i++ )
                                <li class="page-item {{ $projetos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $projetos->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $projetos->nextPageUrl() }}">próxima</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
