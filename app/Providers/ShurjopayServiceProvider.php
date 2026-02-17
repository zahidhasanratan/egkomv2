<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\ShurjopayConfig;

class ShurjopayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Shurjopay::class, function ($app) {
            return new Shurjopay($this->getShurjopayConfig());
        });
    }

    private function getShurjopayConfig(): ShurjopayConfig
    {
        $conf = new ShurjopayConfig();
        $conf->username = config('services.shurjopay.username', env('SP_USERNAME'));
        $conf->password = config('services.shurjopay.password', env('SP_PASSWORD'));
        $conf->api_endpoint = config('services.shurjopay.api', env('SHURJOPAY_API', 'https://sandbox.shurjopayment.com'));
        $conf->callback_url = config('services.shurjopay.callback', env('SP_CALLBACK'));
        $conf->log_path = config('services.shurjopay.log_path', env('SP_LOG_LOCATION', storage_path('logs')));
        $conf->order_prefix = config('services.shurjopay.prefix', env('SP_PREFIX', 'SIC'));
        $conf->ssl_verifypeer = (bool) (env('CURLOPT_SSL_VERIFYPEER', 1));

        return $conf;
    }
}
