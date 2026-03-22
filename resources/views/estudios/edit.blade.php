@extends('layout.layout')
@section('title', 'Editar Estúdio - PokéCenter')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-danger text-white fw-bold">
                Editar Estúdio: {{ $estudio->nome_do_estudio }}
            </div>

            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/estudios/{{ $estudio->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nome_do_estudio" class="form-label fw-bold">Nome do Estúdio *</label>
                        <input type="text" class="form-control" id="nome_do_estudio" name="nome_do_estudio"
                               value="{{ old('nome_do_estudio', $estudio->nome_do_estudio) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-bold">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao"
                                  rows="3">{{ old('descricao', $estudio->descricao) }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ano_fundacao" class="form-label fw-bold">Ano de Fundação</label>
                            <input type="number" class="form-control" id="ano_fundacao" name="ano_fundacao"
                                   value="{{ old('ano_fundacao', $estudio->ano_fundacao) }}"
                                   min="1900" max="{{ date('Y') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="logotipo" class="form-label fw-bold">Logotipo</label>

                            {{-- Mostra o logotipo atual se existir --}}
                            @if($estudio->logotipo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $estudio->logotipo) }}"
                                         alt="Logotipo atual" style="max-height: 80px; border-radius: 6px;">
                                    <p class="form-text">Logotipo atual. Carrega um novo para substituir.</p>
                                </div>
                            @endif

                            <input type="file" class="form-control" id="logotipo"
                                   name="logotipo" accept="image/*">
                            <div class="form-text">Formatos aceites: JPG, PNG, GIF. Máximo 2MB. Deixa em branco para manter o logotipo atual.</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/estudios" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-danger px-4">Guardar Alterações</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
