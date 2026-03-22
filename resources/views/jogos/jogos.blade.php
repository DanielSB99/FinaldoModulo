@extends('layout.layout')
@section('title', isset($estudio) ? 'Jogos - ' . $estudio->nome_do_estudio : 'Todos os Jogos - PokéCenter')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-danger fw-bold">
            @if(isset($estudio))
                Jogos do Estúdio: {{ $estudio->nome_do_estudio }}
            @else
                Todos os Jogos Pokémon
            @endif
        </h2>

        @if(Auth::check() && Auth::user()->tipo == 1)
            <a href="/jogos/create" class="btn btn-danger">+ Novo Jogo</a>
        @endif
    </div>

    {{-- Mensagens de feedback --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Pesquisa e Filtros (só na página geral, não na listagem por estúdio) --}}
    @if(!isset($estudio))
        <form method="GET" action="/jogos" class="mb-4">

            {{-- Barra de pesquisa --}}
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="pesquisa"
                       placeholder="Pesquisar jogo por nome..."
                       value="{{ request('pesquisa') }}">
                <button class="btn btn-danger" type="submit">Pesquisar</button>
                @if(request()->hasAny(['pesquisa', 'genero', 'plataforma', 'pegi', 'ano']))
                    <a href="/jogos" class="btn btn-outline-secondary">Limpar Filtros</a>
                @endif
            </div>

            {{-- Dropdowns de filtro --}}
            <div class="row g-2">
                <div class="col-md-3">
                    <select name="genero" class="form-select form-select-sm">
                        <option value="">-- Género --</option>
                        @foreach($generos as $g)
                            <option value="{{ $g }}" {{ request('genero') == $g ? 'selected' : '' }}>
                                {{ $g }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="plataforma" class="form-select form-select-sm">
                        <option value="">-- Plataforma --</option>
                        @foreach($plataformas as $p)
                            <option value="{{ $p }}" {{ request('plataforma') == $p ? 'selected' : '' }}>
                                {{ $p }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="pegi" class="form-select form-select-sm">
                        <option value="">-- PEGI --</option>
                        @foreach($pegis as $pegi)
                            <option value="{{ $pegi }}" {{ request('pegi') == $pegi ? 'selected' : '' }}>
                                PEGI {{ $pegi }}+
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ano" class="form-select form-select-sm">
                        <option value="">-- Ano de Lançamento --</option>
                        @foreach($anos as $ano)
                            <option value="{{ $ano }}" {{ request('ano') == $ano ? 'selected' : '' }}>
                                {{ $ano }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        {{-- Indicador de resultados --}}
        @if(request()->hasAny(['pesquisa', 'genero', 'plataforma', 'pegi', 'ano']))
            <p class="text-muted mb-3">{{ count($jogos) }} resultado(s) encontrado(s)</p>
        @endif
    @endif

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($jogos as $jogo)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">

                    <div class="bg-dark text-center" style="height: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        @if($jogo->imagem_capa)
                            <img src="{{ asset('storage/' . $jogo->imagem_capa) }}"
                                 alt="{{ $jogo->nome_do_jogo }}"
                                 class="img-fluid" style="min-height: 100%; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default.jpg') }}"
                                 alt="Sem capa"
                                 class="img-fluid" style="min-height: 100%; object-fit: cover;">
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-bold text-truncate" title="{{ $jogo->nome_do_jogo }}">
                            {{ $jogo->nome_do_jogo }}
                        </h5>

                        <ul class="list-unstyled small text-muted mb-3 mt-3">
                            <li><strong>Plataforma:</strong> {{ $jogo->plataforma ?? 'N/A' }}</li>
                            <li><strong>Lançamento:</strong> {{ $jogo->data_lancamento ? \Carbon\Carbon::parse($jogo->data_lancamento)->format('d/m/Y') : 'N/A' }}</li>
                            <li><strong>Género:</strong> {{ $jogo->genero ?? 'N/A' }}</li>
                            <li><strong>PEGI:</strong> {{ $jogo->pegi ?? 3 }}+</li>
                        </ul>
                    </div>

                    @auth
                        <div class="card-footer bg-white border-top-0 pb-3">
                            <div class="d-flex gap-2">
                                <a href="/jogos/{{ $jogo->id }}/edit" class="btn btn-sm btn-outline-primary flex-fill">Editar</a>

                                @if(Auth::user()->tipo == 1)
                                    <form action="/jogos/{{ $jogo->id }}" method="POST" class="flex-fill"
                                          onsubmit="return confirm('Tens a certeza que queres apagar este jogo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">Apagar</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endauth

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted mb-0">Nenhum jogo encontrado.</p>
            </div>
        @endforelse
    </div>

    @if(isset($estudio))
        <div class="mt-4">
            <a href="/estudios" class="btn btn-secondary">&larr; Voltar aos Estúdios</a>
        </div>
    @endif

</div>
@endsection
