<?php

namespace App\Services;

use App\Models\Order;
use App\Notifications\RatingNotification;
use Digikraaft\ReviewRating\Exceptions\InvalidReviewModel;
use Digikraaft\ReviewRating\Models\Review;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class RatingService {

    public static function createOrderReview( Order $model, Model $author, array $data ) {
        
        $review = $data['review'];
        $rating = $data['rating'];
        $title = $data['title'];

        try {
            $review = $model->review($review, $author, $rating, $title);
            Notification::send(
                $model->office->employees()->permission('manage-orders')->get(),
                new RatingNotification($review)
            );
            return $review;

        } catch (InvalidReviewModel $e) {
            throw new $e;
        }

    }

    public static function updateReview( Review $model, array $data ) {
        
        return $model->update($data);

    }
 
}