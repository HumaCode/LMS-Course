<?php

namespace App\Providers;

use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Schema::hasTable('smtp_settings')) {
            $smptsetting = SmtpSetting::first();

            if ($smptsetting && $smptsetting->status == 1) {
                $data = [
                    'driver'        => $smptsetting->mailer,
                    'host'          => $smptsetting->host,
                    'port'          => $smptsetting->port,
                    'username'      => $smptsetting->username,
                    'password'      => $smptsetting->password,
                    'encryption'    => $smptsetting->encryption,
                    'from' => [
                        'address'   => $smptsetting->from_address,
                        'name'      => 'Learn With Me',
                    ],
                ];

                Config::set('mail', $data);
            }
        }
    }
}
