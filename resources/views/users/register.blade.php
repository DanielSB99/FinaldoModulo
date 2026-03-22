@extends('layout.layout')

@section('title', 'Registar - PokéCenter')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0 mt-5">
            <div class="card-header bg-danger text-white text-center fw-bold">
                Registo de Novo Treinador
            </div>
            <div class="card-body p-4">

                {{-- Bloco de erros (ex: emails repetidos, passwords curtas) --}}
                @if ($errors->any())
                    <div class="alert alert-danger pb-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulário de Registo --}}
                <form method="POST" action="/register">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Palavra-passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{-- O Fortify obriga a que este campo se chame exatamente password_confirmation --}}
                            <label for="password_confirmation" class="form-label">Confirmar Palavra-passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-danger">Criar Conta</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
