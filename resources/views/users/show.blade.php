@extends('layout.default')
@section('title', $user->name .'的主页')
@section('content')
    <div class="col-md-6 offset-md-3">
        <section class="user_info">
            @include('shared._user_info')
        </section>
        @can('follow', $user)
        <section class="text-center mt-4">
            @include('shared._follow')
        </section>
        @endcan
        <section class="stats row mt-4">
            @include('shared._stats')
        </section>
        @if(Auth::check() && Auth::user()->id == $user->id)
        <section class="status_form mt-4">
            @include('shared._status_form')
        </section>
        @endif
        <hr>
        <section class="status mt-4">
            @if(count($statuses) > 0)
            <ul class="list-unstyled">
                @foreach($statuses as $status)
                    @include('statuses._status', $status)
                @endforeach
            </ul>
            <div class="mt-4">
                {!! $statuses->render() !!}
            </div>
            @else
            <p class="text-center">Ta还没有发过微博</p>
            @endif
        </section>
    </div>
@stop
