@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4><b>Gestão de geometria</b>
                            <a class="btn btn-sm btn-success float-right" href="{{ route('geometria.create') }}">
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
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Criado em</th>
                                    <th scope="col">Atualizado em</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($geometrias as $geometria)
                                <tr>
                                    <th scope="row">{{ $geometria->id }}</th>
                                    <td>{{ $geometria->nome }}</td>
                                    <td>{{ $geometria->descricao }}</td>
                                    <td>{{ $geometria->tipo }}</td>
                                    <td>
                                        @if ($geometria->created_at)
                                            {{ date('d/m/Y', strtotime($geometria->created_at)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($geometria->updated_at)
                                            {{ date('d/m/Y', strtotime($geometria->updated_at)) }}
                                        @endif
                                    </td>
                                    <td>
                                        <form id="form_{{ $geometria->id }}" method="post" action="{{ route('geometria.destroy', $geometria->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm btn-primary" href="{{ route('geometria.show', $geometria->id) }}"><i class="bi-eye-fill"></i></a>
                                            <a class="btn btn-sm btn-primary" href="{{ route('geometria.edit', $geometria->id) }}"><i class="bi-pencil-fill"></i></a>
                                            <a class="btn btn-sm btn-danger show_confirm" data-id="{{$geometria->id}}" data-nome="{{$geometria->nome}}"><i class="bi-trash-fill"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (isset($geometrias) && !empty($geometrias))
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $geometrias->previousPageUrl() }}">anterior</a></li>
                                @for ( $i = 1; $i <= $geometrias->lastPage(); $i++ )
                                <li class="page-item {{ $geometrias->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $geometrias->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $geometrias->nextPageUrl() }}">próxima</a></li>
                            </ul>
                        </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

<script type="text/javascript">

    $('.show_confirm').click(function(event) {
        const id = $(this).attr("data-id");
        const nome = $(this).attr("data-nome");
        if(!confirm(`Tem certeza que deseja remover a geometria ${nome} (ID: ${id})?`)) {
            event.preventDefault();
            return;
        }
        document.getElementById(`form_${id}`).submit()
    });

</script>

@endsection
