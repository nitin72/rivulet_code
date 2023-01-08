<?php

namespace App\Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','description','user_id'];

    public function user() {
        $this->belongsTo(User::class, 'user_id');
    }    
}
