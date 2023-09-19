<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendUserMail;
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
        $users = User::get();
        return view('admin.index', compact('users'));
    }

    function denyAccess(User $user){
//        $user->is_admin_approve = false;
//        $user->save();
        SendUserMail::dispatch($user->id);

        return redirect()->back();
    }
}
