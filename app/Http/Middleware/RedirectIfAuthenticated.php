<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

class RedirectIfAuthenticated {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct( Guard $auth ) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request , Closure $next ) {
        //dd( Route::current()->getPath() );
        $routeName = Route::getCurrentRoute()->getPath();
        if ( $this->auth->check() ) {
            
            if ( $routeName == "en" || $routeName == "he" ) {
                return new RedirectResponse( route( 'zizhuborders' ) );
            }
            return new RedirectResponse( route( 'admin.dashboard' ) );
        }
        if ( $routeName == "en" || $routeName == "he" ) {
                return new RedirectResponse( route( 'zizhuborders' ) );
            }
        return $next( $request );
    }
}
