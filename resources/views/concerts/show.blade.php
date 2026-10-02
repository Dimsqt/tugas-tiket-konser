@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-bold">Concert Details</h1>
    <a href="{{ route('concerts.index') }}" class="text-indigo-600 hover:text-indigo-800">Back to List</a>
</div>

<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    <div class="mb-4">
        <h2 class="text-xl font-bold text-gray-800">{{ $concert->name }}</h2>
    </div>

    <div class="mb-4">
        <h3 class="text-gray-600 font-semibold">Description</h3>
        <p class="text-gray-800 mt-1 whitespace-pre-line">{{ $concert->description ?? 'No description provided.' }}</p>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <h3 class="text-gray-600 font-semibold">Date & Time</h3>
            <p class="text-gray-800 mt-1">{{ $concert->date->format('F d, Y H:i') }}</p>
        </div>
        <div>
            <h3 class="text-gray-600 font-semibold">Venue</h3>
            <p class="text-gray-800 mt-1">{{ $concert->venue }}</p>
        </div>
        <div>
            <h3 class="text-gray-600 font-semibold">Price</h3>
            <p class="text-gray-800 mt-1">${{ number_format($concert->price, 2) }}</p>
        </div>
    </div>

    <div class="flex justify-end border-t pt-4">
        <a href="{{ route('concerts.edit', $concert) }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Edit Concert</a>
    </div>
</div>
@endsection
