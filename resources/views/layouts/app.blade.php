<!DOCTYPE html>
<html>
<head>
    <title>Finansų sistema</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>
    <header>
        <h1>Finansų apskaita</h1>
        <nav>
            <a href="{{ route('dashboard') }}">Pagrindinis</a>
            <a href="{{ route('transactions.index') }}">Įrašai</a>
            <a href="{{ route('categories.index') }}">Kategorijos</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
