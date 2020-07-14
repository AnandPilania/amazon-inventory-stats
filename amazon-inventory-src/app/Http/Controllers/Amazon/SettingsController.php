<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index (Request $request)
    {
        return view('frontend.amazon');
    }
}
