<?php

namespace App\Infrastructure\Services;

use App\Domain\Interfaces\Services\Logger;
use Illuminate\Log\LogManager;

/**
 * LaravelLogger
 * 
 * Implementación del servicio de logging usando el sistema de Laravel.
 */
class LaravelLogger implements Logger
{
    private LogManager $logger;
    
    /**
     * Constructor
     *
     * @param LogManager $logger
     */
    public function __construct(LogManager $logger)
    {
        $this->logger = $logger;
    }
    
    /**
     * {@inheritdoc}
     */
    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }
    
    /**
     * {@inheritdoc}
     */
    public function error(string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }
    
    /**
     * {@inheritdoc}
     */
    public function warning(string $message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }
    
    /**
     * {@inheritdoc}
     */
    public function debug(string $message, array $context = []): void
    {
        $this->logger->debug($message, $context);
    }
} 