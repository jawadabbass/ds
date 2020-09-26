<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthenticatedException;
use App\Exceptions\UnauthorizedException;
use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;

class AuthRoles
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Throwable
     */
    public function handle($request, Closure $next)
    {

        throw_if(!auth()->check(), UnauthenticatedException::notLoggedIn());

        $action = $request->route()->getActionname();
        $name = $request->route()->getName();

        $role_ids = auth()->user()->getRoleIds();

        $permission = Permission::where(function ($query)use ($action, $name){
            $query->where('permission_name', $name);
            $query->orWhere('permission_action', $action);
        })->whereHas('roles', function ($query) use($role_id){
            $query->whereIn('role_id',$role_ids);
        })->first();

        throw_if(is_null($permission), UnauthorizedException::noPermission());

        return $next($request);
    }
}
