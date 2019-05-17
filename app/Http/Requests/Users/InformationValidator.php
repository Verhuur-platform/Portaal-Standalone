<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class InformationValidator
 *
 * @package App\Http\Requests\Users
 */
class InformationValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Set to true because the authorization check happends
        // On the controller action.

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
            'firstname' => ['required', 'string', 'max:50'],
            'lastname'  => ['required', 'string', 'max:50'],
        ];
    }
}
