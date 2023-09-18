<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Cloudinary;// useする
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post,Request $request,Category $category)
    {
        
         $keyword = $request->input('keyword');

        $query = Post::query();
        // if(!empty($keyword)) {
        //     $query->where('title', 'LIKE', "%{$keyword}%");
        //       // ->orWhere('body', 'LIKE', "%{$keyword}%");
        // }
        $posts = null;
        if(!empty($keyword)) {
        //     $find_prefecture = Category::where('prefecture', $keyword)->first();
        //     $query= Post::where('category_id', $find_prefecture['id']);
        $query = Post::whereHas('category', function ($q) use ($keyword){
    $q->where('prefecture', 'like', '%' . $keyword . '%');
 });
        // 
        }
        

    
   
        $posts = $query->get();
//         $request->validate([
//     'prefecture'=> 'required|in:北海道,青森,岩手,宮城,秋田,山形,福島,茨城,栃木,群馬,埼玉,千葉,東京,神奈川,新潟,富山,石川,福井,山梨,長野,岐阜,静岡,愛知,三重,滋賀,京都,大阪,兵庫,奈良,和歌山,鳥取,島根,岡山,広島,山口,徳島,香川,愛媛,高知,福岡,佐賀,長崎,熊本,大分,宮崎,鹿児島,沖縄',
// ]);
      return view('posts.index', compact('posts', 'keyword'));
      
    }
    
    public function like(Post $post,Request $request,Category $category)
    {
        
       
   $keyword = $request->input('keyword');
        $posts = Auth::user()->posts()->get();
//         $request->validate([
//     'prefecture'=> 'required|in:北海道,青森,岩手,宮城,秋田,山形,福島,茨城,栃木,群馬,埼玉,千葉,東京,神奈川,新潟,富山,石川,福井,山梨,長野,岐阜,静岡,愛知,三重,滋賀,京都,大阪,兵庫,奈良,和歌山,鳥取,島根,岡山,広島,山口,徳島,香川,愛媛,高知,福岡,佐賀,長崎,熊本,大分,宮崎,鹿児島,沖縄',
// ]);
      return view('posts.index')->with(['posts' => $posts, 'keyword'=>$keyword]);
      
    }

    public function show(Post $post,Category $category)
    {
        return view('posts.show')->with(['post' => $post,'category'=>$category]);
    }

    public function create(Category $category)
    {
        return view('posts.create')->with(['categories'=>$category->get()]);
    }

    public function store(Request $request, Post $post)
    {
      
       $input = $request['post'];
        if($request->file('image')){ //画像ファイルが送られた時だけ処理が実行される
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += ['image_url' => $image_url];
        }
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
         
    }
    public function edit(Post $post)
{
    return view('posts.edit')->with(['post' => $post]);
}
public function update(PostRequest $request, Post $post)
{
    $input_post = $request['post'];
    $post->fill($input_post)->save();

    return redirect('/posts/' . $post->id);
}
public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}
public function unlike($post)
    {
            \Auth::user()->unlike($post);
            return back();
    }
    public function likestore(Request $request,$post){
         \Auth::user()->like($post);
            return back();
    }

}
