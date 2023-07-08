<?php
namespace App\Repositories;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\CommentRepositoryInterface;


class CommentRepository implements CommentRepositoryInterface
{
    public function getAllComments($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->with("image")->get();
        // foreach ($comments as $comment) {
        //     if ($comment->image)
        //         $comment["image_path"] = $comment->image->path;
        // }
        return $comments;
    }
    public function getCommentById($postId, $commentId)
    {
        $post = Post::with("image")->findOrFail($postId);
        return $post->comments()->findOrFail($commentId);
    }
    public function deleteComment($postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = $post->comments()->findOrFail($commentId);
        $comment->delete();
    }
    public function createComment($postId, array $commentDetails)
    {
        $post = Post::findOrFail($postId);
        $comment = new Comment($commentDetails);
        $post->comments()->save($comment);
        return $post;
    }
    public function updateComment($commentId, array $commentDetails)
    {
        $comment = Comment::findOrFail($commentId);
        return $comment->update($commentDetails);
    }
    public function create_comment_image($commentId, array $imageDetails)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->image()->create($imageDetails);
    }
    public function getImagePath($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $image = $comment->image;
        if ($image !== null)
            return Storage::url($image->path);
        return null;
    }

}