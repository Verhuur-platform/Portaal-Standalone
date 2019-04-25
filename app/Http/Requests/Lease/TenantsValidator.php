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
        switch ($this->getMethod()) {
            case 'POST':    $methodRules = $this->getPostRules();   break;
            case 'PATCH':   $methodRules = $this->getPatchRules();  break;
            default:        $methodRules = [];
        }

        return array_merge($this->baseRules(), $methodRules);
    }

    /**
     * The base rules for an validation class.
     *
     * @return array
     */
    private function baseRules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:100'],
            'lastname'  => ['required', 'string', 'max:150'],
            'tel_nr'    => ['required', 'string', 'max:50'],
        ];
    }

    /**
     * Validation rules for an PATCH request.
     *
     * @return array
     */
    public function getPatchRules(): array
    {
        return ['email' => ['required', 'string', 'email', 'max:255', 'unique:tenants,email,' . $this->tenant->id ]];
    }

    /**
     * Validation rules for an POST request.
     *
     * @return array
     */
    private function getPostRules(): array
    {
        return ['email' => ['required', 'string', 'email', 'max:255', 'unique:tenants']];
    }
}
