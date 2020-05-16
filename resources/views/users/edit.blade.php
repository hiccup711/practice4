@extends('layout.default')
@section('title', '编辑资料')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5>编辑资料</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')
                <div class="gravatar_edit">
                    <a href="http://www.gravatar.com/emails">
                        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar">
                    </a>
                </div>
                <form action="{{ route("users.update", $user) }}" method="POST">
                    @csrf
                    {{ method_field("PATCH") }}
                    <div class="form-group">
                        <label for="name">名称</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">确认密码</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirm">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
