@extends('layout.layout')

@section('title', 'Recuperar Password - PokéCenter')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0 mt-5">
            <div class="card-header bg-danger text-white text-center fw-bold">
                Recuperar Palavra-passe
            </div>
            <div class="card-body p-4">


                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger pb-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="text-muted small mb-4">
                    Indica o teu email e receberás um link para definires uma nova palavra-passe.
                </p>


                <form method="POST" action="/forgot-password">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-danger">Enviar Link de Recuperação</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="/login" class="text-danger small">Voltar ao Login</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
