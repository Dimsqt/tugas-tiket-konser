<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConcertRequest;
use App\Http\Requests\UpdateConcertRequest;
use App\Models\Concert;

class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concerts = Concert::latest()->get();

        return view('concerts.index', compact('concerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('concerts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConcertRequest $request)
    {
        Concert::create($request->validated());

        return redirect()->route('concerts.index')->with('success', 'Concert created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Concert $concert)
    {
        return view('concerts.show', compact('concert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Concert $concert)
    {
        return view('concerts.edit', compact('concert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConcertRequest $request, Concert $concert)
    {
        $concert->update($request->validated());

        return redirect()->route('concerts.index')->with('success', 'Concert updated successfully.');
    }


}
