@extends('layout.default')
@section('title', $title)
@section('content')
    <div class="col-md-8 offset-md-2">
        <h2 class="text-center mb-4">{{ $title }}</h2>
        <div class="list-group list-group-flush">
            @if(\Illuminate\Support\Facades\Request::route()->getName() == 'users.index')
                @if(count($users) > 0)
                    @foreach( $users as $user)
                    <div class="list-group-item">
                        <img src="{{ $user->gravatar(32) }}" alt="{{ $user->name }}" class="mr-3 gravatar">
                        <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                        @can('destroy', $user)
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="float-right" onsubmit="return confirm('确定删除该用户吗？')">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm">删除</button>
                            </form>
                        @endcan
                    </div>
                    @endforeach
                @endif
            @endif
        </div>
        <div class="mt-4">
            {!! $users->render() !!}
        </div>
    </div>
@stop
