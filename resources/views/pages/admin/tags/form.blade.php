@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-4">{{ $tag->exists ? 'Редактирование тега' : 'Новый тег' }}</h1>

                <form method="POST"
                      action="{{ $tag->exists ? route('admin.tags.update', $tag->slug) : route('admin.tags.store') }}">
                    @csrf
                    @if ($tag->exists)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Название</label>
                        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $tag->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">Отмена</a>
                </form>
            </div>
        </div>
    </div>
@endsection