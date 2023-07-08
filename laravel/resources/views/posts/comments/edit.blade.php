@extends('posts.layout')
@section('content')
    <div class="flex center-center items-center px-8 pt-6 pb-8 mb-4">
        <h2>Edit Comment</h2>

        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto"
            href="{{ route('comments.index', $comment->id) }}">Back</a>

    </div>
    @if ($errors->any())
        <div class="bg-red-500 text-white py-2 px-4 flex items-center">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <form enctype="multipart/form-data" action="{{ route('comments.update', [$post->id, $comment->id]) }}"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="title">
                Title
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="title" name="title" type="text" placeholder="Enter post title"
                value="{{ old() ? old('title') : $comment->title }}">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="description">
                Description
            </label>
            <textarea
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="description" name="description" placeholder="Enter post description" v>{{ old() ? old('description') : $comment->description }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="image">
                Image
            </label>
            <input type="file"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="image" id="image">
            @if ($comment->image)
                <img src="{{ Storage::url($comment->image->path) }}" width="200">
            @endif
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Submit
            </button>

        </div>
    </form>
@endsection
