<small>{{ $item['type'] }}</small>
<small>ID: {{ $item['id'] }}</small>
<small data-index="order">Ix: {{ $item['position']['index'] ?? $loop->iteration }}</small>
<small data-index="order">X: {{ $item['position']['x'] }}</small>