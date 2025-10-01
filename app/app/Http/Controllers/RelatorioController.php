<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        $relatorios = DB::table('RelatorioPorAutor')->get();
        return view('relatorio.index', compact('relatorios'));
    }
}
