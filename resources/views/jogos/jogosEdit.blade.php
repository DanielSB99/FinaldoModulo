@extends('layout.layout')

@section('title', 'Editar Jogo - PokéCenter')

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-danger text-white fw-bold">
                Editar Dados: {{ $jogo->nome_do_jogo }}
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

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- enctype="multipart/form-data" obrigatório para upload de ficheiros --}}
                <form action="/jogos/{{ $jogo->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nome_do_jogo" class="form-label fw-bold">Nome do Jogo *</label>
                        <input type="text" class="form-control" id="nome_do_jogo" name="nome_do_jogo"
                               value="{{ old('nome_do_jogo', $jogo->nome_do_jogo) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="estudio_id" class="form-label fw-bold">Estúdio Responsável *</label>
                        <select class="form-select" id="estudio_id" name="estudio_id" required>
                            <option value="">-- Selecionar Estúdio --</option>
                            @foreach($estudios as $estudio)
                                <option value="{{ $estudio->id }}"
                                    {{ $jogo->estudio_id == $estudio->id ? 'selected' : '' }}>
                                    {{ $estudio->nome_do_estudio }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="plataforma" class="form-label fw-bold">Plataforma</label>
                            <input type="text" class="form-control" id="plataforma" name="plataforma"
                                   value="{{ old('plataforma', $jogo->plataforma) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="data_lancamento" class="form-label fw-bold">Data de Lançamento</label>
                            <input type="date" class="form-control" id="data_lancamento" name="data_lancamento"
                                   value="{{ old('data_lancamento', $jogo->data_lancamento) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="genero" class="form-label fw-bold">Género</label>
                            <input type="text" class="form-control" id="genero" name="genero"
                                   value="{{ old('genero', $jogo->genero) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="pegi" class="form-label fw-bold">Classificação PEGI</label>
                            <input type="number" class="form-control" id="pegi" name="pegi"
                                   value="{{ old('pegi', $jogo->pegi) }}" min="3" max="18">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="imagem_capa" class="form-label fw-bold">Imagem de Capa</label>

                        {{-- Mostra a imagem atual se existir --}}
                        @if($jogo->imagem_capa)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $jogo->imagem_capa) }}"
                                     alt="Capa atual" style="max-height: 120px; border-radius: 6px;">
                                <p class="form-text">Imagem atual. Carrega um novo ficheiro para substituir.</p>
                            </div>
                        @endif

                        <input type="file" class="form-control" id="imagem_capa"
                               name="imagem_capa" accept="image/*">
                        <div class="form-text">Formatos aceites: JPG, PNG, GIF. Máximo 2MB. Deixa em branco para manter a imagem atual.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/jogos" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-danger px-4">Guardar Alterações</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
