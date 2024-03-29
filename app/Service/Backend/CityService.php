<?php
namespace App\Service\Backend;

use App\Models\City;
use App\Http\Requests\Backend\CityRequest;

class CityService
{

    public function index()
    {
      return  City::paginate();
    }

    public function store(CityRequest $request):City
    {
       return City::create($request->validated()+[
        'status' =>$request->filled('status'),
        
       ]);
    }

    public function edit(City $city)
    {
        return $city;
    }

    public function update(CityRequest $request,City $city)
    {
        $city->update($request->validated()+[
            $request->filled('status')
        ]);
    }

    public function destroy(City $city)
    {
        $city->delete();
    }
}
