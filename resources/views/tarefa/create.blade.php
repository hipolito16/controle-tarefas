@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center fw-bold">Adicionar Tarefa</div>
                    <div class="card-body text-center m-auto">
                        @if(Route::has('tarefa.create'))
                            <form method="POST" action="{{ route('tarefa.store') }}">
                                @elseif(Route::has('tarefa.edit'))
                                    <form method="POST"
                                          action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}">
                                        @method('PUT')
                                        @endif
                                        @csrf
                                        <div class="mb-3 text-center">
                                            <label class="form-label">Tarefa</label>
                                            <input type="text" class="form-control text-center" name="tarefa"
                                                   value="{{ isset($tarefa) ? $tarefa->tarefa : old('tarefa') }}">
                                        </div>
                                        @error('tarefa')
                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                        @enderror
                                        <div class="mb-3 text-center">
                                            <label class="form-label">Data Limite Conclusão</label>
                                            <input type="date" class="form-control text-center"
                                                   name="data_limite_conclusao"
                                                   value="{{ isset($tarefa) ? $tarefa->data_limite_conclusao : old('data_limite_conclusao') }}">
                                        </div>
                                        @error('data_limite_conclusao')
                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                        @enderror
                                        <div class="d-flex justify-content-around">
                                        <button type="submit" class="btn btn-primary">{{ isset($tarefa) ? 'Editar' : 'Cadastrar' }}</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
