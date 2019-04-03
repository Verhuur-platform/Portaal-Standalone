<?php

namespace App\Observers;

use App\Notifications\LoginCreated;
use App\User;
use Illuminate\Support\Str;

/**
 * Class UserObserver
 *
 * @package App\Observers
 */
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  User $user The resource entity from the created user in the database.
     * @return void
     */
    public function created(User $user): void
    {
        $password = Str::random(8);

        if ($user->update(['password' => $password])) {
            auth()->user()->logActivity('Logins', "Heeft een login aangemaakt voor {$user->name}");
            $user->notify((new LoginCreated($password))->delay(now()->addMinute()));
        }
    }
}
