@if(Auth::user()->isFollowing($user->id))
    <form action="{{ route('followers.destroy', $user) }}" method="POST">
        @csrf
        {{ method_field("DELETE") }}
        <button class="btn btn-outline-primary" type="submit">取消关注</button>
    </form>
@else
    <form action="{{ route('followers.store', $user) }}" method="POST">
        @csrf
        <button class="btn btn-primary" type="submit">关注</button>
    </form>
@endif
