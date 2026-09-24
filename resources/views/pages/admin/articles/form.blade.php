@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">{{ $article->exists ? 'Редактирование новости' : 'Новая новость' }}</h1>
                <form action="{{ $article->exists ? route('admin.articles.update', $article->slug) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($article->exists)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Заголовок</label>
                        <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $article->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Категория</label>
                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- выбрать --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Текст новости</label>
                        <textarea id="content" name="content" rows="10" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Теги</label>
                        @forelse ($tags as $tag)
                            @php($checkedTags = old('tags', $article->exists ? $article->tags->pluck('id')->all() : []))
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tags[]" id="tag_{{ $tag->id }}" value="{{ $tag->id }}" @checked(in_array($tag->id, $checkedTags))>
                                <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @empty
                            <p class="text-muted small mb-0">Тегов пока нет.</p>
                            <a href="{{ route('admin.tags.create') }}">Добавить тег</a>
                        @endforelse

                        @error('tags')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Изображение</label>
                        @if ($article->exists && $article->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="" style="max-height:120px;">
                            </div>
                        @endif
                        <input id="image" type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                        <input type="hidden" name="is_published" value="0">
                        <input id="is_published" type="checkbox" name="is_published" value="1" class="form-check-input" @checked(old('is_published', $article->is_published))>
                        <label for="is_published" class="form-check-label">Опубликовано</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Отмена</a>
                </form>
            </div>
        </div>
    </div>
@endsection