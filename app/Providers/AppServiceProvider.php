<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

// small helper to probe TCP ports
if (! function_exists('tcp_connectable')) {
    function tcp_connectable(string $host, int $port, float $timeout = 0.5): bool
    {
        $errNo = 0;
        $errStr = '';
        $fp = @stream_socket_client(sprintf('tcp://%s:%d', $host, $port), $errNo, $errStr, $timeout);
        if ($fp === false) {
            return false;
        }
        fclose($fp);
        return true;
    }
}

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // In local development, detect if SMTP mailer is configured but the SMTP
        // endpoint is unreachable (e.g., MailHog not running). If so, fall back
        // to the `log` mailer to avoid runtime Swift_TransportExceptions and
        // surface a clear warning in the logs. This prevents the app from
        // crashing on user actions that trigger mail (register, password reset).
        try {
            $env = env('APP_ENV', 'production');
            $defaultMailer = config('mail.default');
            if ($env === 'local' && in_array($defaultMailer, ['smtp', 'mailhog', 'mail'], true)) {
                $host = env('MAIL_HOST', '127.0.0.1');
                $port = (int) env('MAIL_PORT', 25);
                // quick probe
                if (! tcp_connectable($host, $port, 0.6)) {
                    Log::warning("Mail host {$host}:{$port} is not reachable; falling back to log mailer for local development.");
                    config(['mail.default' => 'log']);
                }
            }
        } catch (\Throwable $e) {
            // If something goes wrong in the probe, do not break the app. Log and continue.
            Log::warning('Mail probe failed: ' . $e->getMessage());
        }
    }
}
