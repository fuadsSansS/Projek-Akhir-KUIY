
    @foreach (request()->segments() as $breadcrumb)
        @if (Str::isUuid($breadcrumb))
        @else
            <a href="{{ $breadcrumb }}"
                class="h3 mb-0 text-gray-800">{{ $breadcrumb }}</a>
        @endif
    @endforeach


