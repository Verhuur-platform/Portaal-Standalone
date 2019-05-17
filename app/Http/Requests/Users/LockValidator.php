<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LockValidator
 *
 * @package App\Http\Requests\Users
 */
class LockValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // $this->user() = Currently authenticated user.
        return $this->user()->can('create-lock', $this->userEntity);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ['confirmatie' => ['required'], 'reden' => ['required', 'string']];
    }
}
