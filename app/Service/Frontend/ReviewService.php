<?php
namespace App\Service\Frontend;

use App\Models\RestaurantReview;
use Illuminate\Support\Facades\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\Frontend\RestaurantReviewRequest;

class ReviewService
{
    public function checkReview(RestaurantReviewRequest $request)
    {
        $userId = auth()->user()->id;
        $products = Cart::content();
        foreach ($products as $product) {
            $branshId = $product->options->restaurant_branche_id;
        }
        $hasReviewed = RestaurantReview::where('user_id', $userId)
            ->where('restaurant_branche_id', $branshId)
            ->where('status', true)
            ->exists();

        if ($hasReviewed) {
            return response()->data(key: 'error', message: 'You have already reviewed this restaurant.', statusCode: 422);
        }

        RestaurantReview::create([
            'user_id' => $userId,
            'restaurant_branche_id' => $branshId, // Correct column name
            'rating' => $request->rating,
            'comment' => $request->comment,
            'review_type' => $request->review_type,
            'title' => $request->title,
        ]);

        return response()->data(
            key: 'error', 
            message: 'Review submitted successfully..',
            statusCode: 200);
    }
    public function showReview($branshId)
    {
        $RestaurantReview = RestaurantReview::with('user:id,name')
            ->where('restaurant_branche_id', $branshId)
            ->get();

        $averageRating = $RestaurantReview->avg('rating');

        return [
            'reviews' => $RestaurantReview,
            'average_rating' => $averageRating,
        ];
    }
}
