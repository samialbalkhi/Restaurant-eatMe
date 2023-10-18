<?php
namespace App\Service\Backend;

use App\Models\Section;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\Backend\SectionRequest;

class SectionService
{
    use ImageUploadTrait;

    public function index()
    {
        return Section::all();
    }

    public function store(SectionRequest $request)
    {
        $path = $this->storeImage('images_section');

        $section = Section::create([
            'name' => $request->name,
            'description' => $request->description,
            'message' => $request->message,
            'status' => $request->status,
            'image' => $path,
        ]);

        return $section;
    }

    public function edit(Section $section)
    {
        return $section->find($section->id);
    }

    public function update(SectionRequest $request, Section $section)
    {
        $this->deleteImage($section);
        $path = $this->storeImage('images_section');

        $section->update([
            'name' => $request->name,
            'description' => $request->description,
            'message' => $request->message,
            'status' => $request->status,
            'image' => $path,
        ]);

    }

    public function destroy(Section $section)
    {
        $this->deleteImage($section);

        $section->delete();
    }
}
