<?php

namespace App\Domain\Interfaces\Services;

/**
 * Logger
 * 
 * Interfaz para servicios de registro de logs.
 * Abstrae el sistema de logging específico que se utilice.
 */
interface Logger
{
    /**
     * Registra un mensaje informativo
     *
     * @param string $message El mensaje a registrar
     * @param array $context Datos adicionales
     * @return void
     */
    public function info(string $message, array $context = []): void;
    
    /**
     * Registra un mensaje de error
     *
     * @param string $message El mensaje a registrar
     * @param array $context Datos adicionales
     * @return void
     */
    public function error(string $message, array $context = []): void;
    
    /**
     * Registra un mensaje de advertencia
     *
     * @param string $message El mensaje a registrar
     * @param array $context Datos adicionales
     * @return void
     */
    public function warning(string $message, array $context = []): void;
    
    /**
     * Registra un mensaje de depuración
     *
     * @param string $message El mensaje a registrar
     * @param array $context Datos adicionales
     * @return void
     */
    public function debug(string $message, array $context = []): void;
} 