<?php

namespace App\Traits;

use Laracasts\Flash\FlashNotifier;

/**
 * Trait FlashMessenger
 *
 * Trait for mapping shortcut functions for the flash session layer.
 *
 * @package App\Traits
 */
trait FlashMessenger
{
    /**
     * Flash an message.
     *
     * @param  string $message The actual flash message.
     * @return FlashNotifier
     */
    public function flashMessage(string $message): FlashNotifier
    {
        return flash($message);
    }

    /**
     * Flash an danger message.
     *
     * @param  string $message The actual danger message.
     * @return FlashNotifier
     */
    public function flashDanger(string $message): FlashNotifier
    {
        return $this->flashMessage($message)->error();
    }

    /**
     * Flash an warning message.
     *
     * @param  string $message The actual warning message.
     * @return FlashNotifier
     */
    public function flashWarning(string $message): FlashNotifier
    {
        return $this->flashMessage($message)->warning();
    }
    
    /**
     * Flash an success message.
     *
     * @param  string $message The actual success message.
     * @return FlashNotifier
     */
    public function flashSuccess(string $message): FlashNotifier
    {
        return $this->flashMessage($message)->success();
    }

    /**
     * Flash an info message.
     *
     * @param  string $message The actual info message.
     * @return FlashNotifier
     */
    public function flashInfo(string $message): FlashNotifier
    {
        return $this->flashMessage($message)->info();
    }
}
