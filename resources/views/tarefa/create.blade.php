@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center fw-bold">{{ !isset($tarefa) ? 'Adicionar' : 'Editar'}} Tarefa
                    </div>
                    <div class="card-body text-center m-auto">
                        @if(!isset($tarefa))
                            <form method="POST" action="{{ route('tarefa.store') }}">
                                @else
                                    <form method="POST"
                                          action="{{ route('tarefa.update', ['tarefa' => $tarefa]) }}">
                                        @method('put')
                                        @endif
                                        @csrf
                                        <div class="mb-3 text-center">
                                            <label class="form-label">Tarefa</label>
                                            <input type="text" class="form-control text-center" name="tarefa"
                                                   value="{{ !isset($tarefa) ? old('tarefa') : $tarefa->tarefa }}">
                                        </div>
                                        @error('tarefa')
                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                        @enderror
                                        <div class="mb-3 text-center">
                                            <label class="form-label">Data Limite Conclusão</label>
                                            <input type="date" class="form-control text-center"
                                                   name="data_limite_conclusao"
                                                   value="{{ !isset($tarefa) ? old('data_limite_conclusao') : $tarefa->data_limite_conclusao }}">
                                        </div>
                                        @error('data_limite_conclusao')
                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                        @enderror
                                        <div class="d-flex justify-content-around">
                                            <button type="submit"
                                                    class="btn btn-primary">{{ !isset($tarefa) ? 'Cadastrar' : 'Editar' }}</button>
                                            <a href="{{ route('tarefa.index') }}"
                                               class="btn btn-secondary">Voltar</a>
                                        </div>
                                    </form>
                                    @if(session('update'))
                                        <div class="alert alert-success mt-3 text-center">{{ session('update') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
