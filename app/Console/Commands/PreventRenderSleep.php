<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PreventRenderSleep extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:self-ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Periodically pings the application to prevent it from sleeping.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = config('app.url');

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $this->info('Successfully pinged the application.');
                Log::info('Self-ping successful.');
            } else {
                $this->error('Failed to ping the application.');
                Log::error('Self-ping failed.', ['status' => $response->status()]);
            }
        } catch (\Exception $e) {
            $this->error('An error occurred while pinging the application.');
            Log::error('Self-ping failed with exception.', ['error' => $e->getMessage()]);
        }
    }
}
