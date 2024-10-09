<?php

namespace App\Jobs;

use App\Models\ShopCart;
use App\Services\ERPService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendShoppingCartData implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ERPService $erpService): void
    {
        
        $shoppingCarts = ShopCart::where('status', 'active')->get();

        // Format the data
        $data = $shoppingCarts->map(function ($cart) {
            return [
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->price,
                'status' => $cart->status,
                'title' => $cart->title,
                'image_url' => $cart->image_url,
                'description' => $cart->description,
            ];
        })->toArray();

        // Send data to ERP
        $erpService->sendShoppingCartData(['data' => $data]);
    }
}
