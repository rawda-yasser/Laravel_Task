@extends('posts.layout')
@section('content')
    <div class="flex center-center items-center px-8 pt-6 pb-8 mb-4">
        <h2>Show Post</h2>

        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto"
            href="{{ route('posts.index') }}">Back</a>

    </div>

    <table class="table-fixed px-8 pt-6 ">
        <thead>
            <tr>
                <th class="w-1/3 px-4 py-2">Title</th>
                <th class="w-2/3 px-4 py-2">Description</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td class="border px-4 py-2">{{ $post->title }}</td>
                <td class="border px-4 py-2">{{ $post->description }}</td>
                @if ($post->image)
                    <img src="{{ Storage::url($post->image->path) }}" width="200">
                @endif
            </tr>
        </tbody>
    </table>
    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-5"
        href="{{ route('comments.create', $post->id) }}">Create comment</a>
    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-5"
        href="{{ route('comments.index', $post->id) }}">Show all comments</a>
@endsection
