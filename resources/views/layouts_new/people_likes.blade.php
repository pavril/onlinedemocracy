<div class="list-group">
  @foreach ($likes as $like)
  <a href="{{ route('search') . '?q=' . $like->user()->firstName() . ' ' . $like->user()->lastName() }}" class="list-group-item"><img class="img-circle text-sized-picture" src="{{ $like->user()->avatar() }}"> {{ $like->user()->firstName() . ' ' . $like->user()->lastName() }}</a>
  @endforeach
</div>