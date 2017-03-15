<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;


class UserController extends Controller
{
    public function profile(int $userId)
    {
        //if userId == AuthuserId, and can show profile, then show
        return var_dump(Auth::user()->getOriginal(), csrf_field());
    }
}
