<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Interfaces\Repositories\UserRepository;
use App\Domain\Interfaces\Services\HashService;
use App\Domain\Interfaces\Services\TokenService;
use App\Infrastructure\Repositories\EloquentUserRepository;
use App\Infrastructure\Services\BcryptHashService;
use App\Infrastructure\Services\JwtTokenService;

/**
 * Class RepositoryServiceProvider
 * @package App\Infrastructure\Providers
 * This class is responsible for binding interfaces to their implementations.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepository::class => EloquentUserRepository::class,
        HashService::class => BcryptHashService::class,
        TokenService::class => JwtTokenService::class,
    ];
    public function register(): void {}
    public function boot(): void
    {
        //
    }
}
