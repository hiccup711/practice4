@if(count($feed_items) > 0)
    <section class="statuses">
        <ul class="list-unstyled">
            @foreach($feed_items as $status)
                @include('statuses._status', ['user' => $status->user])
            @endforeach
        </ul>
    </section>
@else
    <p class="text-center mt-4">还没有人发过微博</p>
@endif
