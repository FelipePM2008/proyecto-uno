<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Notifications\StockProduct;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::with('provider')->simplePaginate(5);
       return view ('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $providers = Provider::all();
        return view('products.create', ['providers' => $providers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->amount = $request->amount;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->provider_id = $request->provider_id;

        $product->save();
        $this->checkLowStock($product);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $producto)
    {
        $providers = Provider::all();

        return view('products.edit', compact('producto', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $producto)
    {
        $producto->code = $request->code;
        $producto->name = $request->name;
        $producto->amount = $request->amount;
        $producto->unit = $request->unit;
        $producto->price = $request->price;
        $producto->provider_id = $request->provider_id;

        $producto->save();
        $this->checkLowStock($producto);
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }

    public function pdf($id){
        $product = Product::find($id);
        $pdf = PDF::loadView('products.pdf', compact('product'));
        return $pdf->stream('product'.$product->id.$product->name.'pdf');
    }

    private function checkLowStock($product){
        if ($product->amount <= 10){
            Notification::route('mail', 'mvalenciaz@sena.edu.co')
            ->notify(new StockProduct($product));
        }
    }
}
