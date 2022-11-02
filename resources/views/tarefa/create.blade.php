@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center fw-bold">Adicionar Tarefa</div>
                    <div class="card-body text-center m-auto">
                        <form method="POST" action="{{ route('tarefa.store') }}">
                            @csrf
                            <div class="mb-3 text-center">
                                <label class="form-label">Tarefa</label>
                                <input type="text" class="form-control text-center" name="tarefa" value="{{ old('tarefa') }}">
                            </div>
                            @error('tarefa')
                            <div class="alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                            <div class="mb-3 text-center">
                                <label class="form-label">Data Limite Conclusão</label>
                                <input type="date" class="form-control text-center" name="data_limite_conclusao" value="{{ old('data_limite_conclusao') }}">
                            </div>
                            @error('data_limite_conclusao')
                            <div class="alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
