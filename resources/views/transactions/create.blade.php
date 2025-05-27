@extends('layouts.app')
@section('content')
<h1>Naujas įrašas</h1>
<form method="POST" action="{{ route('transactions.store') }}">
    @csrf
    <input type="number" step="0.01" name="amount" placeholder="Suma" required>
    <textarea name="description" placeholder="Aprašymas"></textarea>
    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <input type="date" name="date" required>
    <button type="submit">Išsaugoti</button>
</form>
@endsection