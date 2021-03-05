<meta name="robots" content="{{ $metadata->get('robots') }}">
<meta name="description" content="{{ $metadata->get('description') }}">
<meta name="keywords" content="{{ $metadata->get('keywords') }}">
<meta name="author" content="{{ $metadata->get('author') }}">
<title>{{ $metadata->get('title') }}</title>

{{--Open Graph--}}
<meta property="og:title" content="{{ $metadata->get('ogTitle') }}" />
<meta property="og:type" content="{{ $metadata->get('ogType') }}" />
<meta property="og:url" content="{{ $metadata->get('ogUrl') }}" />
<meta property="og:image" content="{{ $metadata->get('ogImage') }}" />
<meta property="og:description" content="{{ $metadata->get('ogDescription') }}" />
<meta property="og:locale" content="{{ $metadata->get('ogLocale') }}" />
<meta property="og:site_name" content="{{ $metadata->get('ogSiteName') }}" />

