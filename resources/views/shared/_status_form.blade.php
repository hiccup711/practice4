<form action="{{ route('statuses.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <textarea name="content" rows="3" class="form-control" placeholder="说说新鲜事..."></textarea>
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">发布</button>
    </div>
</form>
