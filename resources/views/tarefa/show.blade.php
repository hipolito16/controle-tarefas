@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center fw-bold">{{ $tarefa->tarefa }}</div>
                    <div class="card-body text-center m-auto">
                            <div class="mb-3">
                                <label class="form-label">Data Limite Conclusão</label>
                                <label class="form-control bg-secondary" style="--bs-bg-opacity: .1">{{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}</label>
                            </div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                        @if(session('success'))
                            <div class="alert alert-success mt-3 text-center">{{ session('success') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
