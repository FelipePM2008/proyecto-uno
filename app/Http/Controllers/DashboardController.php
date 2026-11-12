<?php

namespace App\Http\Controllers;

use App\Models\Product;

use function Laravel\Prompts\warning;

// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $criticalProducts = Product::where('amount', '<=', 5)->get();
        $warningProducts = Product::whereBetween('amount', [6,30])->get();
        $normalProducts = Product::where('amount', '>', 30)->get();
        return view('dashboard.dashboard', [
            'criticalProducts' =>$criticalProducts,
            'warningProducts' =>$warningProducts,
            'normalProducts' =>$normalProducts,

            'criticalCount' => $criticalProducts->count(),
            'warnincount' => $warningProducts->count(),
            'normalCount' => $normalProducts->count(),

            'totalProducts' => Product::count(),
        ]);
    }
}
