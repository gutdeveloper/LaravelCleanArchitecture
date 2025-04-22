<?php

namespace App\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Infrastructure\Http\Requests
 * This class handles the validation of login requests.
 */
class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:6',
        ];
    }
}
