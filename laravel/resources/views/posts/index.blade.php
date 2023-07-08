@extends('posts.layout')
@section('content')
    <div class="flex content-center items-center">
        <h1>Laravel Task</h1>
        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto"
            href="{{ route('posts.create') }}">Create New post </a>
    </div>
    <h2 class="text-lg text-center">All posts</h2>

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
    @if (count($posts) == 0)
        <p>No posts found</p>
    @else
        <table class="table-auto">
            <tr>
                <th class="px-4 py-2 text-gray-600 font-bold">Title</th>
                <th class="px-4 py-2 text-gray-600 font-bold">Description</th>
            </tr>

            @foreach ($posts as $post)
                <tr>

                    <td class="border px-4 py-2">{{ $post->title }}</td>
                    <td class="border px-4 py-2">{{ $post->description }}</td>

                    <td class="border px-4 py-2 text-right">

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('posts.show', $post->id) }}"
                                class="text-indigo-600 hover:text-indigo-900">Show</a>
                            <span class="text-gray-400">|</span>

                            <a href="{{ route('posts.edit', $post->id) }}"
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
