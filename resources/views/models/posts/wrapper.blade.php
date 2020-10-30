@foreach($data as $item)
<article data-index="{{ $item['position']['index'] ?? $loop->iteration }}" data-position="{{ $item['position']['x'] }}" class="grid-item {{ $item['board']['size'] ?? config('platform.database.boards.columns.classes.4') }} {{ $item['board']['theme'] ?? config('platform.database.boards.themes.default') }}" >
    @include('models.posts.lists.'.$item['type'])
</article>
@endforeach