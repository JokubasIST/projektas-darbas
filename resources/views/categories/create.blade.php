@extends('layouts.app')
@section('content')
<h1>Nauja kategorija</h1>
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Pavadinimas" required>
    <select name="type">
        <option value="income">Pajamos</option>
        <option value="expense">Išlaidos</option>
    </select>
    <button type="submit">Išsaugoti</button>
</form>
@endsection
