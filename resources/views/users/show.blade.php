@extends('layout.default')
@section('title', $user->name .'的主页')
@section('content')
    <section class="user_info">
        @include('shared._user_info')
    </section>
@stop
