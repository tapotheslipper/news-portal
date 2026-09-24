@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Админ-панель</h1>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h5">Новости</h2>
                        <p class="text-muted">Новости (Articles, Статьи).</p>
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-primary btn-sm">Управлять новостями (Articles)</a>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-outline-primary btn-sm">Добавить новость (Article)</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h5">Категории</h2>
                        <p class="text-muted">Категории (Categories)</p>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">Управлять категориями (Categories)</a>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary btn-sm">Добавить категорию (Category)</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h5">Теги</h2>
                        <p class="text-muted">Теги (Tags)</p>
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-primary btn-sm">Управлять тегами (Tags)</a>
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-outline-primary btn-sm">Добавить тег (Tag)</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h5">Комментарии</h2>
                        <p class="text-muted">Комментарии (Comments)</p>
                        <a href="{{ route('admin.comments.index') }}" class="btn btn-primary btn-sm">Управлять комментариями (Comments)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection