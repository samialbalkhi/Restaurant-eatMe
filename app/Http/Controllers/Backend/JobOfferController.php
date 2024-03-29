<?php

namespace App\Http\Controllers\Backend;

use App\Models\Joboffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Backend\jobOfferService;
use App\Http\Requests\Backend\JobOfferRequest;

class jobOfferController extends Controller
{
    public function __construct(private jobOfferService $jobOfferService)
    {
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return response()->json($this->jobOfferService->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobOfferRequest $request)
    {
        return response()->json($this->jobOfferService->store($request), 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Joboffer $jobOffer)
    {
        return response()->json($this->jobOfferService->edit($jobOffer));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(JobOfferRequest $request, Joboffer $jobOffer)
    {
        $this->jobOfferService->update($request, $jobOffer);
        return response()->json(['message' => 'updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Joboffer $jobOffer)
    {
        $this->jobOfferService->destroy($jobOffer);
        return response()->json(
            [
                'message' => 'Deleted successfully',
            ],
            200,
        );
    }
}
