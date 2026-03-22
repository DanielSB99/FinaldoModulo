@extends('layout.layout')
@section('title', 'Novo Jogo - PokéCenter')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-danger text-white fw-bold">
                Adicionar Novo Jogo Pokémon
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

                {{-- enctype="multipart/form-data" obrigatório para upload de ficheiros --}}
                <form action="/jogos" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nome_do_jogo" class="form-label fw-bold">Nome do Jogo *</label>
                        <input type="text" class="form-control" id="nome_do_jogo" name="nome_do_jogo"
                               value="{{ old('nome_do_jogo') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="estudio_id" class="form-label fw-bold">Estúdio Responsável *</label>
                        <select class="form-select" id="estudio_id" name="estudio_id" required>
                            <option value="">-- Selecionar Estúdio --</option>
                            @foreach($estudios as $estudio)
                                <option value="{{ $estudio->id }}"
                                    {{ old('estudio_id') == $estudio->id ? 'selected' : '' }}>
                                    {{ $estudio->nome_do_estudio }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="plataforma" class="form-label fw-bold">Plataforma</label>
                            <input type="text" class="form-control" id="plataforma" name="plataforma"
                                   value="{{ old('plataforma') }}" placeholder="Ex: Nintendo Switch">
                        </div>
                        <div class="col-md-6">
                            <label for="data_lancamento" class="form-label fw-bold">Data de Lançamento</label>
                            <input type="date" class="form-control" id="data_lancamento" name="data_lancamento"
                                   value="{{ old('data_lancamento') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="genero" class="form-label fw-bold">Género</label>
                            <input type="text" class="form-control" id="genero" name="genero"
                                   value="{{ old('genero') }}" placeholder="Ex: RPG">
                        </div>
                        <div class="col-md-6">
                            <label for="pegi" class="form-label fw-bold">Classificação PEGI</label>
                            <input type="number" class="form-control" id="pegi" name="pegi"
                                   value="{{ old('pegi', 3) }}" min="3" max="18">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="imagem_capa" class="form-label fw-bold">Imagem de Capa</label>
                        <input type="file" class="form-control" id="imagem_capa"
                               name="imagem_capa" accept="image/*">
                        <div class="form-text">Formatos aceites: JPG, PNG, GIF. Máximo 2MB.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/jogos" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-danger px-4">Guardar Jogo</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
