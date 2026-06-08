<?php

namespace App\Http\Controllers;

use App\Models\CareSymbol;
use App\Models\SymbolCategory;
use Illuminate\Http\Request;

class SymbolController extends Controller
{
    public function index()
    {
        $categories = SymbolCategory::with('careSymbols')->get();
        $symbols = CareSymbol::all();
        return view('user.symbols', compact('categories', 'symbols'));
    }

    public function show($id)
    {
        $symbol = CareSymbol::findOrFail($id);
        return response()->json($symbol);
    }
}
