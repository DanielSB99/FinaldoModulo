<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstudioController extends Controller
{
    public function index(Request $request)
    {
        $query = Estudio::withCount('jogos');

        // Pesquisa por nome
        if ($request->filled('pesquisa')) {
            $query->where('nome_do_estudio', 'like', '%' . $request->pesquisa . '%');
        }

        $estudios = $query->get();

        return view('estudios.estudios', compact('estudios'));
    }

    public function jogosDoEstudio($id)
    {
        $estudio = Estudio::findOrFail($id);
        $jogos = $estudio->jogos;

        return view('jogos.jogos', compact('jogos', 'estudio'));
    }

    public function create()
    {
        return view('estudios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_do_estudio' => 'required|string|max:255',
            'descricao'       => 'nullable|string',
            'ano_fundacao'    => 'nullable|integer|min:1900|max:' . date('Y'),
            'logotipo'        => 'nullable|image|max:2048',
        ]);

        $caminho = null;
        if ($request->hasFile('logotipo')) {
            $caminho = Storage::putFile('public/logos', $request->file('logotipo'));
            $caminho = str_replace('public/', '', $caminho);
        }

        Estudio::create([
            'nome_do_estudio' => $request->nome_do_estudio,
            'descricao'       => $request->descricao,
            'ano_fundacao'    => $request->ano_fundacao,
            'logotipo'        => $caminho,
        ]);

        return redirect('/estudios')->with('success', 'Estúdio criado com sucesso!');
    }

    public function edit($id)
    {
        $estudio = Estudio::findOrFail($id);

        return view('estudios.edit', compact('estudio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_do_estudio' => 'required|string|max:255',
            'descricao'       => 'nullable|string',
            'ano_fundacao'    => 'nullable|integer|min:1900|max:' . date('Y'),
            'logotipo'        => 'nullable|image|max:2048',
        ]);

        $estudio = Estudio::findOrFail($id);

        $caminho = $estudio->logotipo;
        if ($request->hasFile('logotipo')) {
            if ($estudio->logotipo) {
                Storage::delete('public/' . $estudio->logotipo);
            }
            $caminho = Storage::putFile('public/logos', $request->file('logotipo'));
            $caminho = str_replace('public/', '', $caminho);
        }

        $estudio->update([
            'nome_do_estudio' => $request->nome_do_estudio,
            'descricao'       => $request->descricao,
            'ano_fundacao'    => $request->ano_fundacao,
            'logotipo'        => $caminho,
        ]);

        return redirect('/estudios')->with('success', 'Estúdio atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $estudio = Estudio::findOrFail($id);

        if ($estudio->logotipo) {
            Storage::delete('public/' . $estudio->logotipo);
        }

        $estudio->delete();

        return redirect('/estudios')->with('success', 'Estúdio apagado com sucesso!');
    }
}
