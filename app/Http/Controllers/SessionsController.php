<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }

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
            if(Auth::user()->activated){
                $fallback = route('users.show', [Auth::user()]);
                session()->flash('success', '欢迎回来~');
                return redirect()->intended($fallback);
            }
            else{
                Auth::logout();
                session()->flash('warning', '您的账号还未激活，请查看您的邮箱激活账号');
                return redirect('login');
            }
        }else{
            return back()->withErrors('您的邮箱和密码不匹配')->withInput();
        }
    }
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您的账号已退出');
        return redirect('login');
    }
}
