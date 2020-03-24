<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Marketplace;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    //
    public function index ()
    {
        $marketplaces =   Marketplace::all()->take(5); //auth()->user()->marketplaces()->get();
        return response()->json($marketplaces);
    }
}
