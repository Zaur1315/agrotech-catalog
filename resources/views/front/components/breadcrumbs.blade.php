@props(['items' => []])

<nav class="breadcrumbs" aria-label="Breadcrumb">
    <a href="{{ route('home') }}">Home</a>
    @foreach($items as $item)
        <span aria-hidden="true">/</span>
        @if(!empty($item['url']))
            <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
        @else
            <span aria-current="page">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
