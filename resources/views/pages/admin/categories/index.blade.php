@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Категории (Categories)</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Добавить категорию</a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Новостей</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->articles_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.categories.edit', $category->slug) }}" class="btn btn-sm btn-outline-primary">Изменить</a>
                            <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Удалить категорию {{ $category->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-muted">Категорий пока нет.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection