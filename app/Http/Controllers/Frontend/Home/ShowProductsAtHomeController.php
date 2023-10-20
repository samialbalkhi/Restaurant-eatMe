<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Frontend\Home\ShowProductHome;

class ShowProductsAtHomeController extends Controller
{
    private $ShowProductHome;
    public function __construct(ShowProductHome $ShowProductHome)
    {
        $this->ShowProductHome = $ShowProductHome;
    }
    public function Show_the_last_three_products()
    {
        return response()->json(
            $this->ShowProductHome->Show_the_last_three_products());
    }
    public function FeaturedProduct()
    {
        return response()->json(
            $this->ShowProductHome->FeaturedProduct());
    }
}
