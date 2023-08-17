<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>隠れスポット</title>
    </head>
    <body>
        <h1>隠れスポット</h1>
       <form action="/posts" method="POST" enctype="multipart/form-data">
    
            @csrf
            <div class="title">
                <h2>穴場のパワースポット</h2>
                <input type="text" name="post[title]" placeholder="訪れた場所" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>レビュー</h2>
                <textarea name="post[body]" placeholder="パワースポットでの感想">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
                   <div class="image">
                     <input type="file" name="image">
                    </div>
            <div class="category">
                <h2>都道府県</h2>
            <select name="post[category_id]">
                @foreach($categories as $category)
               
                    <option value="{{ $category->id }}">{{ $category->prefecture }}</option>
                @endforeach
            </select>
        </div>
            <input type="submit" value="投稿"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
</html>