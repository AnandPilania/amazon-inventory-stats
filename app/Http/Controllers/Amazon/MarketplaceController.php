<?php

namespace App\Http\Controllers\Amazon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Amazon\CreateMarketPlaceRequest;
use App\Marketplace;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    //
    public function index ()
    {
        $marketplaces = Marketplace::all()->take(5); //auth()->user()->marketplaces()->get();
        return response()->json($marketplaces);
    }

    public function create (Request $request)
    {
        $validator = validator()->make($request->all(), [

            'seller_id' => 'required',
            'mws_auth_token' => 'required',
            'amazon_marketplace_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(
                ['error' => $validator->errors()->first()],
                422
            );
        }

        // TODO save and validate credentials
        $marketplaces = Marketplace::all()->take(5); //auth()->user()->marketplaces()->get();

        return response()->json([
            'marketplaces' => $marketplaces,
            'message' => 'Marketplace Successfully added'
        ]);
    }
}
