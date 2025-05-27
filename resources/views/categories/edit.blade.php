@extends('layouts.app')
@section('content')
<h1>Redaguoti kategoriją</h1>
<form method="POST" action="{{ route('categories.update', $category) }}">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $category->name }}" required>
    <select name="type">
        <option value="income" @if($category->type=='income') selected @endif>Pajamos</option>
        <option value="expense" @if($category->type=='expense') selected @endif>Išlaidos</option>
    </select>
    <button type="submit">Atnaujinti</button>
</form>
@endsection