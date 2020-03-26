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

        $marketplace =  Marketplace::query()->findOrFail($request->amazon_marketplace_id);

        $request->user()->marketplaces()
            ->sync($marketplace,[
                'mws_auth_token' => $request->mws_auth_token,
                'seller_id' => $request->seller_id,
                ]);

        return response()->json([
            'marketplaces' => [],
            'message' => 'Marketplace Successfully added',
        ]);
    }


}
