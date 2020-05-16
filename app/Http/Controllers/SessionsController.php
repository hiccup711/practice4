<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $credential = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt($credential, $request->has('remember')))
        {
            $fallback = route('users.show', [Auth::user()]);
            session()->flash('success', '欢迎回来~');
            return redirect()->intended($fallback);
        }else{
            return back()->withErrors('您的邮箱和密码不匹配')->withInput();
        }
    }
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您的账号已退出');
        return redirect()->route('home');
    }
}
