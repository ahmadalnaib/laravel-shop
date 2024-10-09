<?php

namespace App\Http\Controllers;

use App\Models\ShopCart;
use Illuminate\Http\Request;
use App\Jobs\SendShoppingCartData;
use Illuminate\Container\Attributes\Log;

class ShopCartController extends Controller
{

    public function sendToERP()
    {
        // Dispatch the job to send shopping cart data to ERP
        SendShoppingCartData::dispatch();

        return response()->json(['message' => 'Shopping cart data is being sent to ERP.'], 200);
    }
    
    public function index()
    {
        $shopingCarts = ShopCart::all();
        return response()->json($shopingCarts);
        
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'product_id' => 'required|exists:products,id',
        //     'quantity' => 'required|integer|min:1',
        //     'price' => 'required|numeric|min:0',
        //     'status' => 'required|in:active,inactive',
        //     'title' => 'required|string|max:255',
        //     'image_url' => 'required|url',
        //     'description' => 'required|string',
        // ]);

        $shopCart = ShopCart::create($request->all());

        return response()->json($shopCart, 201);
    }
}
