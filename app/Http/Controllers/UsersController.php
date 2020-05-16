<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store']
        ]);
    }

    public function create()
    {
        return view('users.create');
    }
    public function index()
    {
        $users = User::paginate(15);
        $title = '所有用户';
        return view('users.index', compact('users', 'title'));
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
        return route('users.show', compact('user'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50|min:3|alpha_dash',
            'password' => 'nullable|min:6'
        ]);
        $data['name'] = $request['name'];
        if($request['password'])
        {
            $data['password'] = bcrypt($request['password']);
        }
        $user->update($data);
        session()->flash('success', '个人信息更新成功');
        return redirect()->route('users.show', compact('user'));
    }
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('info', $user->name .'已被删除');
        return redirect()->back();
    }
}
