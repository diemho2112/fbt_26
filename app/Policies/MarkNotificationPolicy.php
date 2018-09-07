<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class MarkNotificationPolicy
{
    use HandlesAuthorization;

    public function before(Request $request)
    {
        if ($request->has('read')) {
            $notification = $request->user()->notifications()->where('id', $request->read)->first();
            if ($notification) {
                $notification->markAsRead();
            }

            return true;
        }

        return false;
    }
//
//    public function handle($request, Closure $next)
//    {
//        if ($request->has('read')) {
//            $notification = $request->user()->notifications()->where('id', $request->read)->first();
//            if ($notification) {
//                $notification->markAsRead();
//            }
//        }
//
//        return $next($request);
//    }
}
