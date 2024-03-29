<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\RestaurantBranche;
use App\Http\Controllers\Controller;
use App\Service\Backend\restaurantBranchesService;
use App\Http\Requests\Backend\RestaurantBrancheRequest;

class RestaurantBrancheController extends Controller
{
    public function __construct(private restaurantBranchesService $restaurantBranchesService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->restaurantBranchesService->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantBrancheRequest $request)
    {
        return response()->json($this->restaurantBranchesService->store($request));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantBranche $restaurantBranche)
    {
        return response()->json($this->restaurantBranchesService->edit($restaurantBranche));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantBrancheRequest $request, RestaurantBranche $restaurantBranche)
    {
        $this->restaurantBranchesService->update($request, $restaurantBranche);
        return response()->json(['message' => 'Updateed  successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantBranche $restaurantBranche)
    {
        $this->restaurantBranchesService->destroy($restaurantBranche);
        return response()->json(['message' => 'deleted successfully'], 200);
    }
}
