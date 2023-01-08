<?php

namespace App\Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Post\Models\Comment;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','user_id','category_id','img_ext'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
