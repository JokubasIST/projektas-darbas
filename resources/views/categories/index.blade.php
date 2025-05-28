@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Kategorijos</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nauja kategorija
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Pavadinimas</th>
                            <th>Tipas</th>
                            <th class="text-end pe-4">Veiksmai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td class="ps-4 align-middle">
                                <div class="d-flex align-items-center">
                                    <span class="badge me-2" style="background-color: {{ $category->color ?? '#6c757d' }}; width: 16px; height: 16px;"></span>
                                    {{ $category->name }}
                                </div>
                            </td>
                            <td class="align-middle">
                                <span class="badge bg-{{ $category->type === 'income' ? 'success' : 'danger' }}">
                                    {{ $category->type === 'income' ? 'Pajamos' : 'Išlaidos' }}
                                </span>
                            </td>
                            <td class="text-end pe-4 align-middle">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Ar tikrai norite ištrinti šią kategoriją?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">Nėra sukurtų kategorijų</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($categories->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection