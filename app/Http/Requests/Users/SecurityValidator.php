<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Valorin\Pwned\Pwned;

/**
 * Class SecurityValidator
 *
 * @package App\Http\Requests\Users
 */
class SecurityValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // No authorization check is required because the controller action
        // Will be fired on the authenticated user.
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
            'huidig_wachtwoord' => ['required', 'string'],
            'wachtwoord' => ['required', 'string', 'min:8', new Pwned, 'confirmed'],
        ];
    }
}
