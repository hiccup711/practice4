<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store', 'confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
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
        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(15);
        return view('users.show', compact('user', 'statuses'));
    }
    public function store(Request $request){
        $user = $this->validate($request, [
            'name' => 'required|max:50|min:3|alpha_dash',
            'email' => 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:6|max:21'
        ]);
        $user['password'] = bcrypt($user['password']);
        $user = User::create($user);
        $this->sendConfirmEmailTo($user);
        session()->flash('success', '注册成功，请查看您的邮箱来激活账号');
        return redirect()->route('login');
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
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        $user->activation_token = null;
        $user->activated = true;
        $user->save();
        session()->flash('success', '账户已激活，您将在这里开启一段新的旅程~');
        Auth::login($user);
        return view('users.show', compact('user'));
    }
    protected function sendConfirmEmailTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = '43733717@qq.com';
        $name = 'Ricky';
        $to = $user->email;
        $subject = '感谢您注册WeiboApp';
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject){
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

}
