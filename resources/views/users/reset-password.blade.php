@extends('layout.layout')

@section('title', 'Nova Palavra-passe - PokéCenter')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0 mt-5">
            <div class="card-header bg-danger text-white text-center fw-bold">
                Definir Nova Palavra-passe
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


                <form method="POST" action="/reset-password">
                    @csrf

                    
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email', $request->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Palavra-passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar Nova Palavra-passe</label>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger">Guardar Nova Palavra-passe</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
