<?php

namespace App\Traits;

/**
 * Trait Auditable
 *
 * @package App\Traits
 */
trait Auditable
{
    /**
     * Method for logging an internal activity to the log audit table.
     *
     * @param  string $auditName The name from the category where the log needs to be placed under.
     * @param  string $message   The actual audit message in the log.
     * @return void
     */
    public function logActivity(string $auditName, string $message): void
    {
        $user = auth()->user();
        activity($auditName)->performedOn($this)->causedBy($user)->log($message);
    }
}
