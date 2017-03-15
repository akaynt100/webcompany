<?php

namespace App\Http\Controllers;

use App\Models\Setting\Subscribe;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settings()
    {
        return 'view settings';
    }

    public function subscribe()
    {
        return view('user.settings.subscribe');
    }

    public function doUpdateSubscribe(Request $request)
    {
        $subscription = new Subscribe();
        $subscription->subscribe($request->all());
        return back()->with('message.success', trans('notification.settings.subscribe.update'));
    }


}
