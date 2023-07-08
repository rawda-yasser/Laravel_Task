<?php
namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function getAllComments($postId);
    public function getCommentById($postId, $commentId);
    public function deleteComment($postId, $commentId);
    public function createComment($postId, array $commentDetails);
    public function updateComment($commentId, array $commentDetails);
    public function create_comment_image($commentId, array $imageDetails);
    public function getImagePath($commentId);

}