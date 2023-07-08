@extends('posts.layout')
@section('content')
    <div class="flex center-center items-center px-8 pt-6 pb-8 mb-4">
        <h2>Show Comment</h2>

        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto"
            href="{{ route('comments.index', $postId) }}">Back</a>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded  mx-3"
            href="{{ route('posts.show', $postId) }}">Back to post</a>
    </div>

    <table class="table-fixed bg-white shadow-md rounded px-10 py-5 mb-4">
        <thead>
            <tr>
                <th class="w-1/3 px-4 py-2">Title</th>
                <th class="w-2/3 px-4 py-2">Description</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td class="border px-4 py-2">{{ $comment->title }}</td>
                <td class="border px-4 py-2">{{ $comment->description }}</td>
                @if ($comment->image)
                    <img src="{{ Storage::url($comment->image->path) }}" width="200">
                @endif
            </tr>
        </tbody>
    </table>
@endsection
