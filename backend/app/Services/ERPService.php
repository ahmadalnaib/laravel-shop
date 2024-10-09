<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class ERPService
{
    public function sendShoppingCartData(array $data)
    {
        try {
            $response = Http::post('http://localhost:5000/shopingcart', $data);
            if ($response->failed()) {
                // Handle failed request
                $this->cacheData($data);
            }
        } catch (\Exception $e) {
            // Handle exception
            $this->cacheData($data);
        }
    }

    public function cacheData(array $data)
    {
        Cache::put('erp_data', $data, now()->addMinutes(10));
    }

    public function sendCachedData()
    {
        if (Cache::has('erp_data')) {
            $data = Cache::get('erp_data');
            $this->sendShoppingCartData($data);
            Cache::forget('erp_data');
        }
    }
    
}