@props(['items'])

<nav class="legal-toc" aria-label="Table of contents">
    <p class="legal-toc__label">On this page</p>
    <ol>
        @foreach($items as $item)
            <li><a href="#{{ $item['id'] }}"><span>{{ $item['number'] }}</span>{{ $item['label'] }}</a></li>
        @endforeach
    </ol>
</nav>
