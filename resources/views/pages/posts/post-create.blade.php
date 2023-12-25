@extends('base')

@section('title', 'Статьи')

@section('page')
    <div class="page">

        <div class="flex gap-4">
            <a href="/index">Отмена</a>
            <a href="/index">Статьи</a>
            <a href="/logout" class="text-rose-600">Выйти</a>
        </div>

        <form method="post" action="/api/post-create" enctype="multipart/form-data">
            @csrf

            <div>
                @error('title') <div>{{ $message }}</div> @enderror
                <input type="text" name="title" placeholder="Заголовок" required>
            </div>

            <div>
                @error('content') <div>{{ $message }}</div> @enderror
                <textarea name="content" placeholder="Содержание" required></textarea>
            </div>

            <div>
                @error('image') <div>{{ $message }}</div> @enderror
                <input type="file" name="image" accept="image/*">
            </div>

            <button>Создать</button>
        </form>
    </div>
@endsection