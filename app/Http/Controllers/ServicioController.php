<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicioController extends Controller
{
    public function index(): View
    {
        $servicios = Servicio::with('user')->latest()->get();

        return view('servicios.index', compact('servicios'));
    }

    public function create(): View
    {
        return view('servicios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre'            => 'required|string|max:100',
            'descripcion'       => 'nullable|string',
            'precio'            => 'required|numeric|min:0',
            'duracion_estimada' => 'required|integer|min:1',
            'estado'            => 'required|string|max:30',
        ]);

        $validated['user_id'] = auth()->id();

        Servicio::create($validated);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio registrado correctamente.');
    }

    public function destroy(Servicio $servicio): RedirectResponse
    {
        $servicio->delete();

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}
