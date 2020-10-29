@foreach($data as $item)
<article data-id="{{ @$item['postion'] }}" tabindex="{{ $item['id'] }}" class="grid-item {{ $item['settings']['size'] }} {{ $item['settings']['theme'] }}" >
    {{ dd($item) }}
    @include('models.boards.lists.'.$item['type'])
    
</article>
@endforeach