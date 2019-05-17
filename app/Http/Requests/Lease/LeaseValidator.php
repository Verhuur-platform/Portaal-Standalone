<?php

namespace App\Http\Requests\Lease;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LeaseValidator
 *
 * @package App\Http\Requests\Lease
 */
class LeaseValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Returns true because the authorization check happends on
        // The main controller action function.

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
            'firstname'     => ['required', 'string', 'max:191'],
            'lastname'      => ['required', 'string', 'max:191'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:tenants'],
            'start_date'    => ['required', 'date', 'date_format:Y-m-d', 'before:end_date'],
            'end_date'      => ['required', 'date', 'date_format:Y-m-d', 'after:start_date'],
            'persons'       => ['required', 'integer'],
            'status'        => ['required', 'integer'],
        ];
    }
}
