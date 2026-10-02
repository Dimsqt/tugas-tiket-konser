@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-bold">Add Concert</h1>
    <a href="{{ route('concerts.index') }}" class="text-indigo-600 hover:text-indigo-800">Back to List</a>
</div>

<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    <form action="{{ route('concerts.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">Concert Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
            @error('name') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="description">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="date">Date & Time</label>
            <input type="datetime-local" name="date" id="date" value="{{ old('date') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('date') border-red-500 @enderror" required>
            @error('date') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="venue">Venue</label>
            <input type="text" name="venue" id="venue" value="{{ old('venue') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('venue') border-red-500 @enderror" required>
            @error('venue') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2" for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('price') border-red-500 @enderror" required>
            @error('price') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">Save Concert</button>
        </div>
    </form>
</div>
@endsection
