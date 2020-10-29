@foreach($data as $item)
<article data-id="{{ @$item['postion'] }}" tabindex="{{ $item['id'] }}" class="grid-item {{ $item['board']['size'] }} {{ $item['board']['theme'] }}" >
    @include('models.posts.lists.'.$item['type'])
</article>
@endforeach