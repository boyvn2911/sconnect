<?php

namespace SonLeu\SConnect\Notifications;

use Illuminate\Notifications\DatabaseNotification;
use SonLeu\SConnect\Models\User;

/**
 * Trait Notifiable
 * @package SonLeu\SConnect\Notifications
 * @mixin User
 */
trait Notifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function notifications()
    {
        return DatabaseNotification::query()
            ->where('notifiable_type', static::class)
            ->where('notifiable_id', $this->getIdentifier())
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get the entity's read notifications.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function readNotifications()
    {
        return $this->notifications()->whereNotNull('read_at');
    }

    /**
     * Get the entity's unread notifications.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    /**
     * Get the notification routing information for the database driver.
     *
     * @param \Illuminate\Notifications\Notification|null $notification
     * @return mixed
     */
    public function routeNotificationForDatabase($notification = null)
    {
        return $this->notifications();
    }

    public function getIdentifier()
    {
        return $this->id ?? $this->getId();
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users-' . $this->getIdentifier();
    }
}
