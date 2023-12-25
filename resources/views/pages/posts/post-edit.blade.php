@extends('base')

@section('title', $post->title)

@section('page')
    <div class="page">

        <div class="flex gap-4">
            <a href="/post/{{$post->id}}">Отмена</a>
            <a href="/index">Статьи</a>
            <a href="/api/post-remove/{{$post->id}}" class="text-rose-600">Удалить статью</a>
        </div>

        <form method="post" action="/api/post-edit" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="postId" value="{{$post->id}}">

            <h1>Редактировать данные</h1>

            <div>
                @error('title') <div>{{ $message }}</div> @enderror
                <input type="text" name="title" placeholder="Заголовок" required value="{{$post->title}}">
            </div>
            
            <div>
                @error('content') <div>{{ $message }}</div> @enderror
                <textarea type="text" name="content" placeholder="Содержание"
                    required>{{$post->content}}</textarea>
            </div>

            <h1>Прикрепить картнку</h1>

            <div>
                @error('image') <div>{{ $message }}</div> @enderror
                <input type="file" name="image" accept="image/*">
            </div>
        
            <button>Сохранить</button>
        </form>


        @if($post['filepath'])
            <form method="get" action="/api/post-image-remove/{{$post->id}}">
            @csrf

            <div class="flex justify-center">
                <img class="w-32" src="/storage/{{$post->filepath}}">
            </div>
            <button>Удалить картинку</button>
        </form>
        @endif
    </div>
@endsection