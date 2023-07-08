@extends('posts.layout')
@section('content')
    <div class="flex content-center items-center">
        <h2>Laravel Task</h2>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto"
            href="{{ route('comments.create', $postId) }}">Create New Comment </a>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-5"
            href="{{ route('posts.show', $postId) }}">Back to post </a>
    </div>
    @if ($message = Session::get('success'))
        <div class="bg-green-500 text-white py-2 px-4 flex items-center mt-4">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>
                {{ $message }}
            </span>
        </div>
        </div>
    @endif
    @if (count($comments) == 0)
        <p>No comments found</p>
    @else
        <table class="table-auto">
            <tr>
                <th class="px-4 py-2 text-gray-600 font-bold">Title</th>
                <th class="px-4 py-2 text-gray-600 font-bold">Description</th>
            </tr>

            @foreach ($comments as $comment)
                <tr>

                    <td class="border px-4 py-2">{{ $comment->title }}</td>
                    <td class="border px-4 py-2">{{ $comment->description }}</td>

                    <td class="border px-4 py-2 text-right">

                        <form action="{{ route('comments.destroy', [$postId, $comment->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('comments.show', [$postId, $comment->id]) }}"
                                class="text-indigo-600 hover:text-indigo-900">Show</a>
                            <span class="text-gray-400">|</span>

                            <a href="{{ route('comments.edit', [$postId, $comment->id]) }}"
                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <span class="text-gray-400">|</span>
                            <button class="text-red-600 hover:text-red-900" type="submit">Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach

        </table>
    @endif
@endsection
