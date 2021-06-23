<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Subscription;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    public function index()
    {
        $subs = Subscription::all();

        return view('admin.subscribers.index' , ['subs' => $subs]);
    }

    public function create ()
    {
        return view('admin.subscribers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'email' => 'required|email|unique:subscriptions'
        ]);

        Subscription::add($request->get('email'));

        return redirect()->route('subscribers.index');
    }

    public function destroy($id)
    {
        Subscription::find($id)->delete();

        return redirect()->back();
    }
}
