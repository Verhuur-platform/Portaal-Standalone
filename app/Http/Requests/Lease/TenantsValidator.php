<?php

namespace App\Http\Requests\Lease;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TenantsValidator
 *
 * @package App\Http\Requests\Lease
 */
class TenantsValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // No authorization needed because the authorization check.
        // Happends on the controller action.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:100'],
            'lastname'  => ['required', 'string', 'max:150'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:tenants'],
            'tel_nr'    => ['required', 'string', 'max:50'],
        ];
    }
}
