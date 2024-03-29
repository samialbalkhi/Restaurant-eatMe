<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Backend\ProfileAdminService;
use App\Http\Requests\Backend\UpdateProfileRequest;

class ProfileAdminController extends Controller
{
    public function __construct(private ProfileAdminService $ProfileAdminService)
    {
    }

    public function getProfile()
    {
        return response()->json(
            $this->ProfileAdminService->getProfile());
    }

    public function profileAdmin(UpdateProfileRequest $request)
    {
        return  $this->ProfileAdminService->profileAdmin($request);
    }
    public function logout()
    {
            $this->ProfileAdminService->logout();
            return response()->json(
                [
                    'message' => 'logout success',
                ],
                200,
            );
    }


}
