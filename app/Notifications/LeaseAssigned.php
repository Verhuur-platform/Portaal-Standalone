<?php

namespace App\Notifications;

use App\Models\Lease;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * Class LeaseAssigned
 *
 * @package App\Notifications
 */
class LeaseAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Variable for accessing the lease information.
     *
     * @var Lease $lease
     */
    public $lease;

    /**
     * Variable for the authenticated user data.
     *
     * @var User $user
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param  Lease $lease Resource entity from the lease in the application.
     * @param  User  $user  Variable for the authenticated user data.
     * @return void
     */
    public function __construct(Lease $lease, User $user)
    {
        $this->lease = $lease;
        $this->user  = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable The instance from the user who recieves the notification.
     * @return array
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable The instance from the user who recieves the notification.
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'title'       => $this->user->name . ' heeft jouw aangewezen voor een verhuring',
            'body'        => 'Je bent aangewezen als verantwoordelijke opvolger voor de verhuring aan ' . $this->lease->tenant->full_name,
            'action_link' => route('lease.show', $this->lease),
        ];
    }
}
