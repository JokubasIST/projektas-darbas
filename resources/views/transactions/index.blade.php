@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Finansiniai įrašai</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Naujas įrašas
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Data</th>
                    <th>Suma</th>
                    <th>Kategorija</th>
                    <th>Aprašymas</th>
                    <th>Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->date->format('Y-m-d') }}</td>
                    <td class="{{ $transaction->amount < 0 ? 'text-danger' : 'text-success' }}">
                        {{ number_format($transaction->amount, 2) }} €
                    </td>
                    <td>
                        <span class="badge" style="background-color: {{ $transaction->category->color ?? '#6c757d' }}; color: white">
                            {{ $transaction->category->name }}
                        </span>
                    </td>
                    <td>{{ Str::limit($transaction->description, 30) }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-primary mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" onsubmit="return confirm('Ar tikrai norite ištrinti šį įrašą?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Nėra finansinių įrašų</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($transactions->hasPages())
        <div class="d-flex justify-content-center">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
@endsection