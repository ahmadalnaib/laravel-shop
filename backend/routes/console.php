<?php

use App\Services\ERPService;
use App\Jobs\SyncProductsJob;
use App\Jobs\SendShoppingCartData;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new SyncProductsJob)->everyMinute();

Schedule::job(new SendShoppingCartData)->everyMinute();