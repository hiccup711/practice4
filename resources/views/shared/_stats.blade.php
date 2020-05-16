<a href="{{ route('users.followings', $user) }}" class="col-md-4">
    <strong>{{ count($user->followings) }}</strong>
    关注
</a>
<a href="{{ route('users.followers', $user) }}" class="col-md-4">
    <strong>{{ count($user->followers) }}</strong>
    粉丝
</a>
<a href="{{ route('users.show', $user) }}" class="col-md-4">
    <strong>{{ count($user->statuses) }}</strong>
    微博
</a>
