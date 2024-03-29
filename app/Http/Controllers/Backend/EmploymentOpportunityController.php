<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmploymentOpportunity;
use App\Service\Backend\employmentOpportunityService;
use App\Http\Requests\Backend\EmploymentOpportunityRequest;

class employmentOpportunityController extends Controller
{
    public function __construct(private employmentOpportunityService $employmentOpportunityService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->employmentOpportunityService->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmploymentOpportunityRequest $request)
    {
        return response()->json($this->employmentOpportunityService->store($request), 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmploymentOpportunity $employmentOpportunity)
    {
        return response()->json($this->employmentOpportunityService->edit($employmentOpportunity));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmploymentOpportunityRequest $request, EmploymentOpportunity $employmentOpportunity)
    {
        $this->employmentOpportunityService->update($request, $employmentOpportunity);
        return response()->json(['message' => 'Updateed Category successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploymentOpportunity $employmentOpportunity)
    {
        $this->employmentOpportunityService->destroy($employmentOpportunity);
        return response()->json(
            [
                'message' => 'Deleted successfully',
            ],
            200,
        );
    }
}
