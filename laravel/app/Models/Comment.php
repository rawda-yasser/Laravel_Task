<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, "imageable");
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}