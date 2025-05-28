@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0">Redaguoti kategoriją: {{ $category->name }}</h1>
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Pavadinimas*</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $category->name) }}"
                                   placeholder="Įveskite kategorijos pavadinimą" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Tipas*</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                    id="type" 
                                    name="type" 
                                    required>
                                <option value="income" {{ old(type, $category->type) == 'income' ? 'selected' : '' }}>Pajamos</option>
                                <option value="expense" {{ old(type, $category->type) == 'expense' ? 'selected' : '' }}>Išlaidos</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="color" class="form-label">Spalva</label>
                            <input type="color" 
                                   class="form-control form-control-color" 
                                   id="color" 
                                   name="color" 
                                   value="{{ old('color', $category->color ?? '#6c757d') }}"
                                   title="Pasirinkite kategorijos spalvą">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Atnaujinti kategoriją
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection