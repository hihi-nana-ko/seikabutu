<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts(){
    //
    return $this->belongsToMany(Post::class, 'likes');
}
public function like($post)
    {
        $exist = $this->is_like($post);

        if($exist){
            return false;
        }else{
            $this->posts()->attach($post);
            return true;
        }
    }

    public function unlike($post)
    {
        $exist = $this->is_like($post);

        if($exist){
            $this->posts()->detach($post);
            return true;
        }else{
            return false;
        }
    }

    public function is_like($post)
    {
        return $this->posts()->where('user_id',$post)->exists();
    }
}
