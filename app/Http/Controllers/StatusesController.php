<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);
        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success', '发布成功');
        return back();
    }
    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '该条微博已被删除');
        return back();
    }
}
