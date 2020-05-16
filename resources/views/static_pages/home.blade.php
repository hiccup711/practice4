@extends('layout.default')
@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if(Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('shared._status_form')
                </section>
                <hr>
                @include('shared._feed')
            </div>
            <div class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info', ['user'=>Auth::user()])
                </section>
                <section class="stats row mt-4">
                    @include('shared._stats', ['user'=>Auth::user()])
                </section>
            </div>
        </div>
    @else
    <div class="jumbotron">
        <h1>Hello Laravel</h1>
        <p class="lead">你现在所看到的是 <a href="">Laravel入门教程</a> 的示例项目主页
        </p>
        <p>一切，将从这里开始</p>
        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg" role="button">现在注册</a>
    </div>
    @endif
@stop
