@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg text-white">
    <h1 class="text-2xl font-bold mb-4">Edit Author</h1>

    <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-semibold mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}" required
                class="w-full px-4 py-2 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring focus:ring-orange-500" />
        </div>

        <div>
            <label for="avatar" class="block text-sm font-semibold mb-1">Avatar</label>
            <input type="file" name="avatar" id="avatar"
                class="w-full px-4 py-2 bg-gray-700 rounded border border-gray-600 file:text-white file:bg-orange-600 file:border-0 file:px-4 file:py-2" />
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.authors.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                Cancel
            </a>
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
