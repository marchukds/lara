<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main component - {{ config('app.name', 'Front page') }}</title>
</head>
<body>
<div>
    {{-- page content --}}

    @if(isset($header))
        <header>
            {{ $header }}
        </header>
    @endif

    <main>
        {{ $slot }}
    </main>

    @if(isset($footer))
        <footer>
            {{ $footer }}
        </footer>
    @endif
</div>
</body>
</html>
