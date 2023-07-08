<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status'];
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, "imageable");
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}