<?php

namespace App\Http\Controllers\Admin;

use App\Events\Cancellation;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function index(Request $request)
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'customer');
        })->get();
        return view('admin.index', compact('users'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    function denyAccess(User $user)
    {
        $user->is_admin_approve = false;
        $user->save();
        /**
         * this event is to cancel the access of user. to make it scaleable we can implement queues here.
         */
        Cancellation::dispatch($user->id);
        return redirect()->back();
    }
}
