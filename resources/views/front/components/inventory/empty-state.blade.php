<div class="inventory-empty" data-reveal>
    <svg aria-hidden="true" viewBox="0 0 64 64"><path d="M10 46h44M16 46V28h18v18M34 46V20h14v26M22 28v-8h8v8M42 20v-6h6v6"/><path d="M20 36h5M39 29h5M39 37h5"/></svg>
    <h2>{{ $content['title'] }}</h2>
    <p>{{ $content['description'] }}</p>
    <div class="inventory-empty__actions"><a class="btn-primary" href="{{ $clearUrl }}">Clear Filters</a><a class="btn-outline" href="{{ route('contact.index') }}">Contact Our Team</a></div>
</div>
