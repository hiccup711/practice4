<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function store(Request $request){
        $user = $this->validate($request, [
            'name' => 'required|max:50|min:3|alpha_dash',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:6|max:21'
        ]);
        $user['password'] = bcrypt($user['password']);
        $user = User::create($user);
        session()->flash('success', '注册成功，请查看您的邮箱来激活账号');
        return view('users.show', compact('user'));
    }
}
