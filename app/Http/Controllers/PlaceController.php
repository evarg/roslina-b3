<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Place;
use App\Models\User;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;

class PlaceController extends Controller
{
    public function index()
    {
        $Places = Place::latest()->get();
        
        if (is_null($Places->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No place found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Places are retrieved successfully.',
            'data' => $Places,
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlaceRequest $request)
    {
        $userID = Auth::id();
        $place = Place::create($request->all());
        $place->users()->attach($userID);

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
    public function show($id)
    {
        $place = Place::findOrFail($id);
        $place->load(["users", "containers"]);

        $response = [
            'status' => 'success',
            'message' => 'Place is retrieved successfully.',
            'data' => $place,
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validate->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $Place = Place::find($id);

        if (is_null($Place)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Place is not found!',
            ], 200);
        }

        $Place->update($request->all());
        
        $response = [
            'status' => 'success',
            'message' => 'Place is updated successfully.',
            'data' => $Place,
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Place = Place::find($id);
  
        if (is_null($Place)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Place is not found!',
            ], 200);
        }

        Place::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Place is deleted successfully.'
            ], 200);
    }

    /**
     * Search by a Place name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $Places = Place::where('name', 'like', '%'.$name.'%')
            ->latest()->get();

        if (is_null($Places->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No Place found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Places are retrieved successfully.',
            'data' => $Places,
        ];

        return response()->json($response, 200);
    }

}
