<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getByLimit(int $limit_count = 10)
    {
        
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
   
   
    protected $fillable = [
    'title',
    'body',
    'category_id',
    'image_url',
    ];

  public function users()
    
  {
    return $this->belongsToMany(User::class, 'likes');
  }

/**
  * リプライにLIKEを付いているかの判定
  *
  * @return bool true:Likeがついてる false:Likeがついてない
  */
  public function is_liked_by_auth_user()
  {
    $id = Auth::id();

    $likers = array();
    foreach($this->likes as $like) {
      array_push($likers, $like->user_id);
    }

    if (in_array($id, $likers)) {
      return true;
    } else {
      return false;
    }
    return $this->belongsToMany(User::class,'likes','post_id','user_id')->withTimestamps();

  }
}
