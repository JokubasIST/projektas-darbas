@extends('layouts.app')
@section('content')
<h1>Kategorijos</h1>
<a href="{{ route('categories.create') }}">+ Nauja kategorija</a>
<table>
    <tr><th>Pavadinimas</th><th>Tipas</th><th>Veiksmai</th></tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{ $category->name }}</td>
        <td>{{ $category->type }}</td>
        <td>
            <a href="{{ route('categories.edit', $category) }}">Redaguoti</a>
            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                @csrf @method('DELETE')
                <button type="submit">Trinti</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection