<?php 

namespace App\Interfaces; 

use Laracasts\Flash\FlashNotifier;

/**
 * Interface FlashMessengerInterface 
 * 
 * @package App\Interfaces
 */
interface FlashMessengerInterface
{
    /**
     * Flash an message 
     * 
     * @param  string $message The actual flash message. 
     * @return FlashNotifier
     */
    public function flashMessage(string $message): FlashNotifier;

    /**
     * Flash an danger message 
     * 
     * @param  string $message The actual flash message. 
     * @return FlashNotifier
     */
    public function flashDanger(string $message): FlashNotifier; 

    /**
     * Flash an warning message 
     * 
     * @param  string $message The actual flash message. 
     * @return FlashNotifier
     */
    public function flashWarning(string $message): FlashNotifier;

    /**
     * Flash an success message 
     * 
     * @param  string $message The actual flash message. 
     * @return FlashNotifier
     */
    public function flashSuccess(string $message): FlashNotifier; 

    /**
     * Flash an info message 
     * 
     * @param  string $message The actual flash message. 
     * @return FlashNotifier
     */
    public function flashInfo(string $message): FlashNotifier;
}