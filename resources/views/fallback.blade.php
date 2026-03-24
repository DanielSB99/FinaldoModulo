@extends('layout.layout')

@section('content')
    <div class="text-center mt-5">
        <h1>404 - Página não encontrada</h1>
        <p>A página que procuras não existe.</p>
        <a href="{{ url('/') }}">Voltar ao início</a>
    </div>
@endsection
