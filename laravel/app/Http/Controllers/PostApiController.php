<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\PostRepositoryInterface;

class PostApiController extends Controller
{
    private PostRepositoryInterface $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        // $posts = $this->postRepository->getPostsRedis();
        $posts = $this->postRepository->getAllPosts();

        return response()->json([
            'data' => $posts,
            'message' => 'Posts retrieved successfully!',
            'status' => 'success'
        ]);
    }
    public function store(PostRequest $request)
    {

        $post = $this->postRepository->createPost($request->validated());
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->postRepository->create_post_image($post->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }

        return response()->json([
            'data' => $post,
            'message' => 'Post added successfully!',
            'status' => 'success'
        ]);

    }
    public function getImagePath($postId)
    {
        $imagePath = $this->postRepository->getImagePath($postId);
        return response()->json([
            'data' => $imagePath,
            'message' => 'Image retrieved successfully!',
            'status' => 'success'
        ]);
    }
    public function show($postId)
    {
        $data = $this->postRepository->getPostById($postId);

        $imagePath = $this->postRepository->getImagePath($postId);
        if ($imagePath)
            $data['imagePath'] = $imagePath;
        return response()->json([
            'data' => $data,
            'message' => 'Post retrieved successfully!',
            'status' => 'success'
        ]);
    }
    public function update(PostRequest $request, $postId)
    {
        $postDetails = $request->validated();
        $this->postRepository->updatePost($postId, $postDetails);
        $data = $this->postRepository->getPostById($postId);
        if ($request->image) {
            // Storage::delete($data->image->path);
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->postRepository->create_post_image($data->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }
        $imagePath = $this->postRepository->getImagePath($postId);
        if ($imagePath != null)
            $data['imagePath'] = $imagePath;

        return response()->json([
            'data' => $data,
            'message' => 'Post updated successfully!',
            'status' => 'success'
        ]);

    }
    public function destroy($postId)
    {
        $post = $this->postRepository->getPostById($postId);
        if ($post->image)
            Storage::delete($post->image->path);

        $this->postRepository->deletePost($post->id);

        return response()->json([
            'data' => $post,
            'message' => 'Post deleted successfully!',
            'status' => 'success'
        ]);

    }
}