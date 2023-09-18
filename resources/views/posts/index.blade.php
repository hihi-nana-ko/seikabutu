<!DOCTYPE html>
<x-app-layout>
    <x-slot name="header">
        隠れスポット
        </x-slot>
        <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>隠れスポット</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>隠れスポット</h1>
        <div class='posts'>
            <a href='/posts/create'>投稿</a>
            <div>
  <form action="{{ route('index') }}" method="GET">
    <input type="text"name="keyword" value="{{ $keyword }}">
    <input type="submit" value="検索">
  </form>
</div>

            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
    @csrf
    @method('DELETE')
    <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 

</form>
<script>
    function deletePost(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>
                </div>
            @endforeach
            
        </div>
        {{--<div class='paginate'>
            {{ $posts->links() }}
        </div>--}}
    </body>
</html>
</x-app-layout>