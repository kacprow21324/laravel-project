<?php

namespace App\Http\Controllers;

use App\Models\Usluga;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Wyświetla stronę z cennikiem usług
     */
    public function oferta()
    {
        $uslugi = Usluga::orderBy('nazwa')->get();
        
        return view('pages.oferta', compact('uslugi'));
    }
}
