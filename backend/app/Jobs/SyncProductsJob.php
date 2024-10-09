<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncProductsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // https://fakestoreapi.com/products
        $response = Http::get('http://localhost:5001/products');

        if ($response->successful()) {
            $products = $response->json();
            // DB::connection('pgsql')->table('products')->truncate();
            // Prepare the data for upsert
 
            foreach ($products as $product) {
                $productData = [
                    'id' => $product['id'],
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'description' => $product['description'],
                    'category' => $product['category'],
                    'image' => $product['image'],
                    // 'rating_rate' => $product['rating']['rate'],
                    // 'rating_count' => $product['rating']['count'],
                    "created_at" => now(),
                    

                ];
                DB::connection('pgsql')->table('products')->updateOrInsert(
                    ['id' => $product['id']], // Unique key to determine if the record should be updated
                    $productData // Data to update
                );

                // Fetch the updated product from the database
                $updatedProduct = Product::find($product['id']);

                // Update the Meilisearch index
                $updatedProduct->searchable();
            }
        }
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
