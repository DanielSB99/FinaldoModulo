<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JogoController extends Controller
{
    public function index(Request $request)
    {
        $query = Jogo::query();

        // Pesquisa por nome
        if ($request->filled('pesquisa')) {
            $query->where('nome_do_jogo', 'like', '%' . $request->pesquisa . '%');
        }

        // Filtro por género
        if ($request->filled('genero')) {
            $query->where('genero', $request->genero);
        }

        // Filtro por plataforma
        if ($request->filled('plataforma')) {
            $query->where('plataforma', $request->plataforma);
        }

        // Filtro por PEGI
        if ($request->filled('pegi')) {
            $query->where('pegi', $request->pegi);
        }

        // Filtro por ano de lançamento
        if ($request->filled('ano')) {
            $query->whereYear('data_lancamento', $request->ano);
        }

        $jogos = $query->get();

        $generos     = Jogo::whereNotNull('genero')->distinct()->orderBy('genero')->pluck('genero');
        $plataformas = Jogo::whereNotNull('plataforma')->distinct()->orderBy('plataforma')->pluck('plataforma');
        $pegis       = Jogo::whereNotNull('pegi')->distinct()->orderBy('pegi')->pluck('pegi');
        $anos        = Jogo::whereNotNull('data_lancamento')
                           ->selectRaw('YEAR(data_lancamento) as ano')
                           ->distinct()
                           ->orderBy('ano', 'desc')
                           ->pluck('ano');

        return view('jogos.jogos', compact('jogos', 'generos', 'plataformas', 'pegis', 'anos'));
    }

    public function create()
    {
        $estudios = Estudio::all();

        return view('jogos.jogosCreate', compact('estudios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_do_jogo'    => 'required|string|max:255',
            'estudio_id'      => 'required|integer|exists:estudios_table,id',
            'data_lancamento' => 'nullable|date',
            'plataforma'      => 'nullable|string|max:100',
            'genero'          => 'nullable|string|max:100',
            'pegi'            => 'nullable|integer|min:3|max:18',
            'imagem_capa'     => 'nullable|image|max:2048',
        ]);

        $caminho = null;
        if ($request->hasFile('imagem_capa')) {
            $caminho = Storage::putFile('capas', $request->file('imagem_capa'));
        }

        Jogo::create([
            'nome_do_jogo'    => $request->nome_do_jogo,
            'estudio_id'      => $request->estudio_id,
            'imagem_capa'     => $caminho,
            'data_lancamento' => $request->data_lancamento,
            'plataforma'      => $request->plataforma,
            'genero'          => $request->genero,
            'pegi'            => $request->pegi,
        ]);

        return redirect('/jogos')->with('success', 'Jogo criado com sucesso!');
    }

    public function edit($id)
    {
        $jogo     = Jogo::findOrFail($id);
        $estudios = Estudio::all();

        return view('jogos.jogosEdit', compact('jogo', 'estudios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_do_jogo'    => 'required|string|max:255',
            'estudio_id'      => 'required|integer|exists:estudios_table,id',
            'data_lancamento' => 'nullable|date',
            'plataforma'      => 'nullable|string|max:100',
            'genero'          => 'nullable|string|max:100',
            'pegi'            => 'nullable|integer|min:3|max:18',
            'imagem_capa'     => 'nullable|image|max:2048',
        ]);

        $jogo    = Jogo::findOrFail($id);
        $caminho = $jogo->imagem_capa;

        if ($request->hasFile('imagem_capa')) {
            if ($jogo->imagem_capa) {
                Storage::delete($jogo->imagem_capa);
            }
            $caminho = Storage::putFile('capas', $request->file('imagem_capa'));
        }

        $jogo->update([
            'nome_do_jogo'    => $request->nome_do_jogo,
            'estudio_id'      => $request->estudio_id,
            'imagem_capa'     => $caminho,
            'data_lancamento' => $request->data_lancamento,
            'plataforma'      => $request->plataforma,
            'genero'          => $request->genero,
            'pegi'            => $request->pegi,
        ]);

        return redirect('/jogos')->with('success', 'Os dados do Pokémon foram atualizados com sucesso!');
    }

    public function destroy($id)
    {
        $jogo = Jogo::findOrFail($id);

        if ($jogo->imagem_capa) {
            Storage::delete($jogo->imagem_capa);
        }

        $jogo->delete();

        return redirect()->back()->with('success', 'Jogo apagado com sucesso!');
    }
}
