<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use App\Interfaces\CommentRepositoryInterface;

class CommentController extends Controller
{
    private CommentRepositoryInterface $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($postId)
    {
        $comments = $this->commentRepository->getAllComments($postId);
        return view("posts.comments.index", compact("comments", "postId"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($postId)
    {
        return view("posts.comments.create", compact("postId"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, $postId)
    {
        $comment = $this->commentRepository->createComment($postId, $request->validated());
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->commentRepository->create_comment_image($comment->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }
        return redirect()->route('comments.index', compact("postId"))->with([
            'message' => 'Comment added successfully!',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($postId, $commentId)
    {
        $comment = $this->commentRepository->getCommentById($postId, $commentId);
        return view("posts.comments.show", compact("postId", "comment"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = $post->comments()->find($commentId);

        return view("posts.comments.edit", compact("post", "comment"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, $postId, $commentId)
    {
        $post = Post::findOrFail($postId);
        $comment = $post->comments()->findOrFail($commentId);
        if ($request->image) {
            // Storage::delete($data->image->path);
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->commentRepository->create_comment_image($comment->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }
        $this->commentRepository->updateComment($commentId, $request->validated());

        return redirect()->route('comments.index', $postId)->with('success', 'Comment updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postId, $commentId)
    {
        $this->commentRepository->deleteComment($postId, $commentId);
        return redirect()->route('comments.index', $postId)->with('success', 'Comment deleted successfully');
    }
}