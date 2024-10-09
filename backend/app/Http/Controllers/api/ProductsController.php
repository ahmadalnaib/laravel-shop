<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Jobs\SyncProductsJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Exception;

class ProductsController extends Controller
{

    
    public function sync()
    {
        // Dispatch the sync job
        // SyncProductsJob::dispatch();
        // return response()->json(['message' => 'Sync job dispatched']);
    }
    

    public function index()
    {


        // Attempt to fetch products from the external API
        // https://fakestoreapi.com/products
        // $response = Http::get('http://localhost:5000/products');

        // if ($response->successful()) {
        //     $products = $response->json();
        //     // Prepare the response data
        //     $data = ['products' => $products, 'can_buy' => true];
        // } else {
        //     // Fetch products from the secondary database if the API request fails
        //     $products = DB::connection('pgsql')->table('products')->get();
        //     $data = ['products' => $products, 'can_buy' => false];
        // }

        // // Return the response as JSON
        // return response()->json($data);
        try {
            $url = 'http://localhost:5001/products';
            $response = file_get_contents($url);
            if ($response === FALSE) {
                throw new Exception('Failed to fetch data from URL');
            }
            $products = json_decode($response, true);
            $data = ['products' => $products, 'can_buy' => true];
        } catch (Exception $e) {
            // Fallback to database
            $data = $this->loadProductsFromDatabase();
        }

        return response()->json($data);
    }

    private function loadProductsFromDatabase()
    {
        $products = DB::connection('pgsql')->table('products')->get();
       
        return ['products' => $products, 'can_buy' => false];
    }
    

    public function show($id)
    {
        
        // https://fakestoreapi.com/products
        // $response = Http::get("http://localhost:5000/products/{$id}");

        // if ($response->successful()) {
        //     $product = $response->json();
 
          
        //     $data = ['product' => $product, 'can_buy' => true];
        // } else {
        //     // Fetch product from the secondary database
        //     $product = DB::connection('pgsql')->table('products')->where('id', $id)->first();
        //     $data = ['product' => $product, 'can_buy' => false];
        // }

        // return response()->json($data);

        try {
            $response = Http::get("http://localhost:5001/products/{$id}");
            if ($response->successful()) {
                $product = $response->json();
                $data = ['product' => $product, 'can_buy' => true];
            } else {
                throw new Exception('Failed to fetch data from URL');
            }
        } catch (Exception $e) {
            // Fallback to database
            $data = $this->loadProductFromDatabase($id);
        }

        return response()->json($data);
    }

    private function loadProductFromDatabase($id)
    {
        $product = DB::connection('pgsql')->table('products')->find($id);
        return ['product' => $product, 'can_buy' => false];
    }
    }
