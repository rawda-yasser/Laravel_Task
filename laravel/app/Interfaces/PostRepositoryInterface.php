<?php
namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getPostById($postId);
    public function deletePost($postId);
    public function createPost(array $postDetails);
    public function updatePost($postId, array $postDetails);
    public function create_post_image($postId, array $imageDetails);
    public function getImagePath($postId);
    public function getPostsRedis();
}