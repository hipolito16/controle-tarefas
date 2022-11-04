@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center fw-bold">Tarefas</div>
                    <div class="card-body">
                        <table class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th>Tarefa</th>
                                <th>Data Limite Conclusão</th>
                                <th colspan="3">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tarefas as $tarefa)
                                <tr>
                                    <td>{{ $tarefa->tarefa }}</td>
                                    <td>{{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}</td>
                                    <td><a href="{{ route('tarefa.show', ['tarefa' => $tarefa]) }}"
                                           class="text-decoration-none icofont-eye-alt"></a></td>
                                    <td><a href="{{ route('tarefa.edit', ['tarefa' => $tarefa]) }}"
                                           class="text-decoration-none icofont-ui-edit"></a></td>
                                    <td>
                                        <form id="form_{{ $tarefa->id }}"
                                              action="{{ route('tarefa.destroy', ['tarefa' => $tarefa]) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#"
                                               onclick="document.getElementById('form_{{ $tarefa->id }}').submit()"
                                               class="text-decoration-none icofont-ui-delete"></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <nav class="d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Voltar</a>
                                </li>
                                @for($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}"><a
                                            class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a></li>
                                @endfor
                                <li class="page-item"><a class="page-link"
                                                         href="{{ $tarefas->nextPageUrl() }}">Avançar</a></li>
                            </ul>
                        </nav>
                        @if(session('destroy'))
                            <div class="alert alert-info mt-3 text-center">{{ session('destroy') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
