@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Теги (Tags)</h1>
            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Добавить тег</a>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
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
                @forelse ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->articles_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.tags.edit', $tag->slug) }}" class="btn btn-sm btn-outline-primary">Изменить</a>
                            <form action="{{ route('admin.tags.destroy', $tag->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить тег {{ $tag->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted">Тегов пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection