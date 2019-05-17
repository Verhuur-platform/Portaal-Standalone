<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Facades\Hash;

/**
 * Trait SecuredRequestTrait
 * ----
 * Trait for securing actions with an hash check of the authenticated user.
 *
 * @todo Refactor to custom rule object. <https://laravel.com/docs/5.8/validation#custom-validation-rules>
 *
 * @package App\Traits
 */
trait SecuredRequest
{
    /**
     * Method for mapping the authenticated user to an function.
     *
     * @return User
     */
    public function getAuthUser(): User
    {
        return auth()->user();
    }

    /**
     * The validation rules for the confirmation form.
     *
     * @return array
     */
    public function securedRequestRules(): array
    {
        return ['confirmatie' => ['required', 'string']];
    }

    /**
     * Method for performing the check for securing the request.
     *
     * @param  string  $confirmation The given user password.
     * @return bool
     */
    public function isRequestSecured(string $confirmation): bool
    {
        return Hash::check($confirmation, $this->getAuthUser()->getAuthPassword());
    }
}
