<?php

namespace App\Http\Controllers\Backend;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Backend\SectionService;
use App\Http\Requests\Backend\SectionRequest;

class SectionController extends Controller
{

    private $SectionService;
    public function __construct(SectionService $SectionService)
    {
        $this->SectionService = $SectionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->SectionService->index());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        $section = $this->SectionService->store($request);
        return response()->json($section,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return response()->json(
            $this->SectionService->edit($section));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        $this->SectionService->update($request, $section);
        return response()->json(['message' => 'updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $this->SectionService->destroy($section);
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
