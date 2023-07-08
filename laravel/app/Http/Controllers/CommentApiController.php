<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\CommentRepositoryInterface;

class CommentApiController extends Controller
{
    private CommentRepositoryInterface $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function index($postId)
    {

        $data = $this->commentRepository->getAllComments($postId);
        return response()->json([
            'data' => $data,
            'message' => 'Comment retrieved successfully!',
            'status' => 'success'
        ]);
    }
    public function show($postId, $commentId)
    {
        $comment = $this->commentRepository->getCommentById($postId, $commentId);
        $imagePath = $this->commentRepository->getImagePath($commentId);
        if ($imagePath)
            $comment['imagePath'] = $imagePath;
        return response()->json([
            'data' => $comment,
            'message' => 'Comment retrieved successfully!',
            'status' => 'success'
        ]);
    }

    public function store(CommentRequest $request, $postId)
    {
        $comment = $this->commentRepository->createComment($postId, $request->validated());
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->commentRepository->create_comment_image($comment->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }
        return response()->json([
            'data' => $comment,
            'message' => 'Comment created successfully!',
            'status' => 'success'
        ]);
    }
    public function update(CommentRequest $request, $postId, $commentId)
    {
        $this->commentRepository->updateComment($commentId, $request->validated());
        $data = $this->commentRepository->getCommentById($postId, $commentId);
        if ($request->image) {
            // Storage::delete($data->image->path);
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            $this->commentRepository->create_comment_image($data->id, ['name' => $fileName, 'path' => "public/images/" . $fileName]);
        }
        $imagePath = $this->commentRepository->getImagePath($commentId);
        $data['imagePath'] = $imagePath;

        return response()->json([
            'data' => $data,
            'message' => 'Comment updated successfully!',
            'status' => 'success'
        ]);
    }
    public function destroy($postId, $commentId)
    {
        $data = $this->commentRepository->getCommentById($postId, $commentId);
        $this->commentRepository->deleteComment($postId, $commentId);
        return response()->json([
            'data' => $data,
            'message' => 'Comment updated successfully!',
            'status' => 'success'
        ]);
    }
}