@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Redaguoti įrašą</h1>
    <form method="POST" action="{{ route('transactions.update', $transaction) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="amount">Suma</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" 
                   value="{{ old('amount', $transaction->amount) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Aprašymas</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $transaction->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Kategorija</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Data</label>
            <input type="date" class="form-control" id="date" name="date" 
                   value="{{ old('date', $transaction->date->format('Y-m-d')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atnaujinti</button>
    </form>
</div>
@endsection