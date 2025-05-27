@extends('layouts.app')

@section('content')
<h1>Visi finansiniai įrašai</h1>
<a href="{{ route('transactions.create') }}">+ Naujas įrašas</a>
<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Suma</th>
            <th>Kategorija</th>
            <th>Veiksmai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->date }}</td>
            <td>{{ $transaction->amount }} €</td>
            <td>{{ $transaction->category->name }}</td>
            <td>
                <a href="{{ route('transactions.edit', $transaction) }}">Redaguoti</a>
                <form method="POST" action="{{ route('transactions.destroy', $transaction) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Trinti</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
