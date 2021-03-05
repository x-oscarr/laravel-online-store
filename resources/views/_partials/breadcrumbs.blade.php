@isset($breadcrumbs)
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-50">
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if($breadcrumb->url && !$loop->last)
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                            <span class="material-icons breadcrumb-arrow">east</span>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
@endif
