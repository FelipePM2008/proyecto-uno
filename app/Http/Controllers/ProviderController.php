<?php

namespace App\Http\Controllers;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Mostrar la lista de proveedores.
     */
    public function index()
    {
        $providers = Provider::all();

        return view('providers.index', compact('providers'));
    }

    /**
     * Mostrar el formulario para registrar un proveedor.
     */
    public function create()
    {
        return view('providers.create');
    }

    /**
     * Guardar un nuevo proveedor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nit' => 'required|string|max:50|unique:providers,nit',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        Provider::create($validated);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    /**
     * Mostrar la información de un proveedor.
     */
    public function show(Provider $proveedore)
    {
        return view('providers.show', [
            'provider' => $proveedore
        ]);
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(Provider $proveedore)
    {
        return view('providers.edit', [
            'provider' => $proveedore
        ]);
    }

    /**
     * Actualizar un proveedor.
     */
    public function update(Request $request, Provider $proveedore)
    {
        $validated = $request->validate([
            'nit' => 'required|string|max:50|unique:providers,nit,' . $proveedore->id,
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        $proveedore->update($validated);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Eliminar un proveedor.
     */
    public function destroy(Provider $proveedore)
    {
        if ($proveedore->products()->exists()) {
            return redirect()
                ->route('proveedores.index')
                ->with(
                    'error',
                    'No se puede eliminar el proveedor porque tiene productos asociados.'
                );
        }

        $proveedore->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}
