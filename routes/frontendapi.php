<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\{
    ReviewController,
    Home\GetSectionController,
    ProfileCustomerController,
    DeliverySection\CartController,
    VerifyCity\VerifyCityController,
    DeliverySection\OrederController,
    Home\ShowProductsAtHomeController,
    ShowProduct\ShowProductController,
    ShowCategory\ShowCategoryController,
    DeliverySection\ShowAllProductController,
    DeliverySection\ShowAllCategoryController,
    ShowSectioMycafe\ShowSectioMycafeController,
    ShowOurRestaurant\ShowOurRestaurantController,
    ShowSectioFamily\ShowSectioMyFamilyController,
    ShowSectionCareer\ShowSectionCareerController,
    DeliverySection\ShowRestaurantBrancheController,
    ShowSectionCareer\EmploymentApplicationController,
    ShowOurResponsibiliy\ShowOurResponsibiliyController,
    ShowSectionCareer\ShowEmploymentOpportunitiesController,
};

/////////////////    frontend         //////////////////////
Route::group(['prefix' => 'Home'], function () {
    Route::get('getSection', GetSectionController::class);
    //////////// Display the products on the home page, the last three products and the last four featured products     ////////////////////
    Route::get('Show_the_last_three_products', [ShowProductsAtHomeController::class, 'Show_the_last_three_products']);
    Route::get('FeaturedProduct', [ShowProductsAtHomeController::class, 'FeaturedProduct']);
});

//////////     View category information   ///////////////////////
Route::get('getCategory/{category}', ShowCategoryController::class);

/////        Display the products + display the product itself    /////
Route::get('ShowProduct/{product}', [ShowProductController::class, 'ShowProduct']);
Route::get('getOneProduct/{product}', [ShowProductController::class, 'getOneProduct']);

//// View the mycafy section + all its contents /////
Route::get('ShowSectioMycafe/{section}', ShowSectioMycafeController::class);

/////////////////////       Show information section Family            /////////////////////
Route::get('ShowSectioMyFamily/{section}', ShowSectioMyFamilyController::class);

//////////////       View our responsibility section information        /////////////////
Route::get('ShowOurResponsibiliy/{section}', ShowOurResponsibiliyController::class);

//////////   View information in our restaurant section //////////////////
Route::get('ShowOurRestaurant/{section}', ShowOurRestaurantController::class);

//////    View information in the Career section    ////////////////
Route::get('ShowSectionCareer/{section}', ShowSectionCareerController::class);
////////////      View job opportunities in the Career section           /////////////////////
Route::controller(ShowEmploymentOpportunitiesController::class)->group(function () {
    Route::get('ShowEmploymentOpportunities', 'ShowEmploymentOpportunities');
    ////////////     View the job offer in the Professional Life section                ////////////////////////
    Route::get('ShowJobOffer/{jobOffer}', 'ShowJobOffer');
    Route::get('ViewOneJobOffer/{jobOffer}', 'ViewOneJobOffer');
});

////         Submit a job request by the user    /////////////////////////////
Route::post('/employmentApplication', EmploymentApplicationController::class);

/////////       Verify whether delivery is available in this city or not  //////////////
Route::post('/verifyCities', VerifyCityController::class);
///////           View  in the delivery section     //////////////////////
Route::get('/showAllCategory', ShowAllCategoryController::class);
Route::get('/showAllProduct/{product}', ShowAllProductController::class);

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => 'cart'], function () {
        Route::controller(CartController::class)->group(function () {
            Route::post('/store', 'store');
            Route::get('/numberOfProduct', 'numberOfProduct');
            Route::get('/show', 'show');
            Route::get('/subtotal', 'subtotal');
            Route::delete('/delete/{rowId}', 'delete');
        });
    });
});


Route::get('/showRestaurantBranche/{restaurantBranche}', ShowRestaurantBrancheController::class);

Route::group(['middleware' => ['web']], function () {
    Route::post('/order', [OrederController::class, 'store']);
});

Route::group(['middleware' => ['auth:sanctum', 'abilities:customer']], function () {
    Route::controller(ProfileCustomerController::class)->group(function () {
        Route::get('/getProfileCustomer', 'getProfileCustomer');
        Route::post('/profileCustomer', 'profileCustomer');
        Route::get('logout', 'logout');
    });

    Route::group(['middleware' => ['web']], function () {
        Route::post('/review', [ReviewController::class, 'checkReview']);
    });
});
////////////////       Show comments about the restaurant ////////////////////
Route::get('/showreview/{branshId}', [ReviewController::class, 'showReview']);


Route::group(['prefix' => 'customer'], function () {
    Route::post('register', [ProfileCustomerController::class, 'register']);
});
