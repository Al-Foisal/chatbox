<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;
    protected $guarded = [];

    public function images() {
        return $this->hasMany(PostImage::class);
    }

    public function videos() {
        return $this->hasMany(PostVideo::class);
    }

    public function comments() {
        return $this->hasMany(PostComment::class);
    }

    public function likes() {
        return $this->hasMany(PostLike::class);
    }
}