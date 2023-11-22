<?php
namespace App\Service\Backend;

use App\Models\Driver;
use App\Models\RestaurantBranche;
use App\Http\Requests\Backend\DriverRequest;

class DriverService
{
    public function index()
    {
        return Driver::with(['restaurantBranche:id,name'])->get();
    }

    public function store(DriverRequest $request): Driver
    {
        $restaurantBranche = RestaurantBranche::find($request->restaurant_branche_id);

        return $restaurantBranche->drivers()->create($request->validated()+[
            'status' =>$request->filled('status'),
        ]);
    }

    public function edit(Driver $driver)
    {
        return $driver->find($driver->id);
    }

    public function update(DriverRequest $request, Driver $driver)
    {
        $driver->update($request->validated()+[
            $request->filled('status')
        ]);
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
    }
}
