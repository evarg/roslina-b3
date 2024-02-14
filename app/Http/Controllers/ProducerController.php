<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Producer;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producers = Producer::latest()->get();
        
        if (is_null($producers->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No producers found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Producers are retrieved successfully.',
            'data' => $producers,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProducerRequest $request)
    {
        $place = Producer::create($request->all());
        $userId = Auth::id();
        $place->users()->attach($userId);

        $response = [
            'status' => 'success',
            'message' => 'Place is added successfully.',
            'data' => $place,
        ];

        return response()->json($response, 200);        
    }

    /**
     * Display the specified resource.
     */
    public function show(Producer $producer)
    {
        $producer = Producer::find($id);
        $producer->load(["users"]);

        if (is_null($producer)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Place is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Place is retrieved successfully.',
            'data' => $producer,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producer $producer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProducerRequest $request, Producer $producer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producer $producer)
    {
        //
    }
}
