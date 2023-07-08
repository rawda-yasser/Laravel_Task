<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        $posts = $this->postRepository->getAllPosts();
        return view("posts.index", compact('posts'));
    }
    public function create()
    {
        return view("posts.create");
    }
    public function store(PostRequest $request)
    {

        $post = $this->postRepository->createPost($request->validated());
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->postRepository->create_post_image($post->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }

        return redirect()->route('posts.index')->with([
            'message' => 'Post added successfully!',
            'status' => 'success'
        ]);
    }
    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }
    public function edit(Post $post)
    {
        return view("posts.edit", compact("post"));
    }
    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->description = trim($request->input('description'));
        $this->postRepository->updatePost($post->id, ['title' => $post->title, 'description' => $post->description]);
        if ($request->image) {
            // Storage::delete($post->image->path);
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->postRepository->create_post_image($post->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }
    public function destroy(Post $post)
    {

        if ($post->image)
            Storage::delete($post->image->path);

        $this->postRepository->deletePost($post->id);

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}