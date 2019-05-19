<?php

namespace App\Http\Requests\Tenants;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BillingValidator
 *
 * @package App\Http\Requests\Tenants
 */
class BillingValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // No authorization check needed because this happends on the controller action class.
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
            'country' => ['required', 'string'],
            'postal' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string']
        ];
    }
}
