@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verifique seu endereço de E-Mail.</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Um novo link de verificação foi enviado para seu endereço de e-mail.
                            </div>
                        @endif

                        Antes de continuar, verifique seu e-mail para validarmos o seu acesso com o link de verificação.
                        <br>
                        Se você não recebeu o e-mail, clique aqui para solicitar outro link de verificação.
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui</button>
                            .
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
