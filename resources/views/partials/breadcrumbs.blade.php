@unless ($breadcrumbs->isEmpty())
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <nav class="breadcrumbs">
                    <a href="{{ $breadcrumb->url }}">Home</a>
                </nav>
            @else
                <nav class="breadcrumbs">
                    <a href="{{ $breadcrumb->url }}">Home</a>
                    <a href="{{ route('admin.home') }}">Dashboard</a>
                    <a href="{{ route('admin.home') }}">{{ $breadcrumb->title }}</a>
                </nav>
            @endif

        @endforeach
    </ol>
@endunless
