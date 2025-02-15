<?php

namespace FrozenLeaves\OpenAILaravel;

use FrozenLeaves\OpenAILaravel\Enums\ApiVersion;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class OpenAIServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/openai.php' => $this->app->configPath('openai.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->singleton(Client::class, function () {
            return new Client(
                Config::get('openai.access_token'),
                ApiVersion::V1,
            );
        });
    }
}