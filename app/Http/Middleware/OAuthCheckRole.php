<?php

namespace LaravelDelivery\Http\Middleware;

use Closure;
use LaravelDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class OAuthCheckRole
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        $user_id = Authorizer::getResourceOwnerId();
        $user = $this->userRepository->find($user_id);

        if($user->role != $role){
            abort(403, 'Access Forbidden');
        }

        return $next($request);
    }
}
