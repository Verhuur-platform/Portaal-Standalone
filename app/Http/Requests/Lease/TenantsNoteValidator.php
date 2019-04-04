<?php

namespace App\Http\Requests\Lease;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TenantsNoteValidator
 *
 * @package App\Http\Requests\Lease
 */
class TenantsNoteValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // No authorization check needed here because the check
        // Mainly happen on the controller action class.

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
            'titel' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ];
    }
}
