<?php 

namespace App\Composers; 

use Illuminate\Contracts\Auth\Guard;
use Illuminate\View\View;

/**
 * Class LayoutComposer 
 * 
 * @package App\Composers
 */
class AccountComposer 
{
    /**
     * The guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    
    /**
     * AccountComposer constructor
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view The view builder instance. 
     * @return void
     */
    public function compose(View $view): void
    {
        if ($this->auth->check()) {
            $view->with('currentUser', $this->auth->user());
        }
    }
}