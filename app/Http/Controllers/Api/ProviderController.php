<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $providers = Provider::with('products')->get();

        return response()->json(['data' => $providers], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nit' => 'nullable|string|max:20|unique:providers,nit',
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:200',
        ]);

        $provider = Provider::create($validated);

        return response()->json(['provider' => $provider], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $provider = Provider::with('products')->findOrFail($id);

            return response()->json(['data' => $provider], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Proveedor no encontrado',
                'code' => 404,
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $provider = Provider::findOrFail($id);

            $validated = $request->validate([
                'nit' => 'nullable|string|max:20|unique:providers,nit,'.$id,
                'name' => 'sometimes|required|string|max:150',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:100',
                'address' => 'nullable|string|max:200',
            ]);

            $provider->update($validated);

            return response()->json(['data' => $provider], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Proveedor no encontrado',
                'code' => 404,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $provider = Provider::findOrFail($id);
            $provider->delete();

            return response()->json([
                'providerDelete' => $provider,
                'message' => 'Proveedor eliminado correctamente',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Proveedor no encontrado',
                'code' => 404,
            ], 404);
        }
    }
}
