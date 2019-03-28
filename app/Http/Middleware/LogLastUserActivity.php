<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class LogLastUserActivity
 * 
 * @package App\Http\Middleware
 */
class LogLastUserActivity
{
    /**
     * The Guard implementation.
     *
     * @var Guard $guard
     */
    protected $auth;
    
    /**
     * Create new LogLastUserActivity instance. 
     * 
     * @param  Guard $auth The authentication guard variable.
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            $expiresAt = now()->addMinutes(5);
            Cache::put('user-is-online-' . $this->auth->user()->id, $expiresAt);
        }

        return $next($request);
    }
}
