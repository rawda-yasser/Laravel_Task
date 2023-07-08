<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Redis;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        $posts = Post::with("image")->get();
        // foreach ($posts as $post) {
        //     if ($post->image)
        //         $post["imagePath"] = $post->image->path;
        // }
        return $posts;
    }
    public function getPostById($postId)
    {
        return Post::with('image')->findOrFail($postId);
    }
    public function deletePost($postId)
    {
        Post::destroy($postId);
    }
    public function createPost(array $postDetails)
    {
        return Post::create($postDetails);
    }
    public function updatePost($postId, array $postDetails)
    {
        $post = Post::findOrFail($postId);
        return $post->update($postDetails);
    }
    public function create_post_image($postId, array $imageDetails)
    {
        $post = Post::find($postId);
        $post->image()->create($imageDetails);
    }
    public function getImagePath($postId)
    {
        $post = Post::findOrFail($postId);
        $image = $post->image;
        if ($image !== null)
            return Storage::url($image->path);
        return null;
    }
    public function getPostsRedis()
    {
        $value = Redis::get("all_posts");
        if ($value === null) {
            Redis::set("all_posts", $this->getAllPosts());
        }
        return json_decode($value, false);
    }

}