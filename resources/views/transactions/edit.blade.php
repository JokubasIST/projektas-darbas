@extends('layouts.app')

@section('content')
<h1>Redaguoti įrašą</h1>
<form method="POST" action="{{ route('transactions.update', $transaction) }}">
    @csrf
    @method('PUT')
    <input type="number" step="0.01" name="amount" value="{{ $transaction->amount }}" required>
    <textarea name="description">{{ $transaction->description }}</textarea>
    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if($transaction->category_id == $category->id) selected @endif>{{ $category->name }}</option>
        @endforeach
    </select>
    <input type="date" name="date" value="{{ $transaction->date }}" required>
    <button type="submit">Atnaujinti</button>
</form>
@endsection
