<?php
namespace App\Service\RestaurantOwner;

use Illuminate\Http\Request;
use App\Models\RestaurantOwner;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Frontend\UpdateProfileRestaurantOwnerRequest;

class profileRestaurantOwnerService
{
    public function getProfileRestaurantOwner()
    {
        return RestaurantOwner::find(auth('restaurantOwner')->user()->id);
    }

    public function profileRestaurantOwner(UpdateProfileRestaurantOwnerRequest $request)
    {
        $restaurantOwner = auth('restaurantOwner')->user();
        $nameAndEmail = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
        ];
        if ($request->old_password) {
            if (Hash::check($request->old_password, $restaurantOwner->password) == true) {
                $nameAndEmail = array_merge($nameAndEmail, [
                    'password' => $request->new_password,
                ]);
            } else {
                return response()->data(key: 'error',
                 message: 'old password  not correct',
                 statusCode: 422
                );
            }
        }

        auth()
            ->user()
            ->update($nameAndEmail);

        return response()->data(key: 'success',
         message: 'update profile sucessfully',
        statusCode: 200
        );
    }
    public function logout()
    {
        auth('restaurantOwner')->user()
        ->user()
        ->tokens()
        ->delete();
    }
}
