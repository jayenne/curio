@foreach($data as $item)
<article data-size="33" data-index="{{ $item['id'] }}"  data-position="{{ $item['position']['x'] ?? 0.0 }}" class="grid-item {{ $item['board']['size'] }} {{ $item['board']['theme'] }}" >
    @include('models.posts.lists.'.$item['type'])
</article>
@endforeach