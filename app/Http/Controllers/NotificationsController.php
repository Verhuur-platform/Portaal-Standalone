<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

/**
 * Class NotificationsController
 *
 * @package App\Http\Controllers
 */
class NotificationsController extends Controller
{
    /**
     * NotificationsController constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Method to mark all the unread notifications as read.
     *
     * @return RedirectResponse
     */
    public function markAll(): RedirectResponse
    {
        $this->getAuthenticatedUser()->unreadNotifications()->update(['read_at' => now()]);
        return redirect()->route('notifications.index');
    }

    /**
     * Get the index page for the notifications from the authenticated user.
     *
     * @param  string|null $type The type of notifications you want to display.
     * @return Renderable
     */
    public function index(?string $type = null): Renderable
    {
        $user = $this->getAuthenticatedUser();

        switch ($type) {
            case 'all':
                $notifications = $user->notifications()->simplePaginate(10);
                $type = 'all';
                break;

            default: // No type parameter given so display the unread notifications as default.
                $notifications = $user->unreadNotifications()->simplePaginate(10);
                $type = 'read';
                break;
        }

        return view('notifications.index', compact('notifications', 'type'));
    }
}
