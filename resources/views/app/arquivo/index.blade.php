@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4><b>Gestão de arquivos</b>
                            <a class="btn btn-sm btn-success float-right" href="{{ route('arquivo.create') }}">
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
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Arquivo (nome original)</th>
                                    <th scope="col">Criado em</th>
                                    <th scope="col">Atualizado em</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arquivos as $arquivo)
                                <tr>
                                    <th scope="row">{{ $arquivo->id }}</th>
                                    <td>{{ $arquivo->nome }}</td>
                                    <td>{{ $arquivo->tipo }}</td>
                                    <td><a href="{{route('arquivo.download', $arquivo->id)}}"><i class="bi bi-box-arrow-down"></i></a> {{ $arquivo->nome_original }}</td>
                                    <td>
                                        @if ($arquivo->created_at)
                                            {{ date('d/m/Y', strtotime($arquivo->created_at)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($arquivo->updated_at)
                                            {{ date('d/m/Y', strtotime($arquivo->updated_at)) }}
                                        @endif
                                    </td>
                                    <td>
                                        <form id="form_{{ $arquivo->id }}" method="post" action="{{ route('arquivo.destroy', ['arquivo' => $arquivo->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a class="btn btn-sm btn-primary" href="{{ route('arquivo.show', $arquivo->id) }}"><i class="bi-eye-fill"></i></a>
                                            <a class="btn btn-sm btn-primary" href="{{ route('arquivo.edit', $arquivo->id) }}"><i class="bi-pencil-fill"></i></a>
                                            <a class="btn btn-sm btn-danger show_confirm" data-id="{{$arquivo->id}}" data-nome="{{$arquivo->nome}}"><i class="bi-trash-fill"></i></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $arquivos->previousPageUrl() }}">anterior</a></li>
                                @for ( $i = 1; $i <= $arquivos->lastPage(); $i++ )
                                <li class="page-item {{ $arquivos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $arquivos->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $arquivos->nextPageUrl() }}">próxima</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>


    </div>

<script type="text/javascript">

    $('.show_confirm').click(function(event) {
        const id = $(this).attr("data-id");
        const nome = $(this).attr("data-nome");
        if(!confirm(`Tem certeza que deseja remover o arquivo ${nome} (ID: ${id})?`)) {
            event.preventDefault();
            return;
        }
        document.getElementById(`form_${id}`).submit()
    });

</script>

@endsection
