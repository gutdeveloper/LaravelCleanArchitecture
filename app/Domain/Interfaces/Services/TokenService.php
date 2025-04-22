<?php

namespace App\Domain\Interfaces\Services;

use App\Domain\Entities\UserEntity;

/**
 * Interface TokenService
 * @package App\Domain\Interfaces\Services
 * This interface defines the contract for generating JWT tokens.
 */
interface TokenService
{
    /**
     * Generate a JWT token.
     *
     * @param array $payload
     * @return string
     */
    public function generate(array $payload): string;
}
