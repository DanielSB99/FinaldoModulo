@extends('layout.layout')

@section('title', 'Entrar - PokéCenter')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0 mt-5">
            <div class="card-header bg-danger text-white text-center fw-bold">
                Acesso ao PokéCenter
            </div>
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger pb-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email de Treinador</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Palavra-passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-danger">Entrar</button>
                    </div>
                </form>


                <div class="text-center mt-3">
                    <a href="/forgot-password" class="text-danger small">Esqueceste a palavra-passe?</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
