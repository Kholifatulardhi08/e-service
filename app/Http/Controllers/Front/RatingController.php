<?php

namespace App\Http\Controllers\Front;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function addRating(Request $request)
    {
        if (!Auth::check()) {
            $message = "Login to Rate this Product!";
            return redirect()->back()->with('error_message', $message);
        }
        if ($request->isMethod('POST')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $user_id = Auth::user()->id;
            $ratingcount = Rating::where(['user_id'=>$user_id, 'product_id'=>$data['product_id']])->count();
            if ($ratingcount>0) {
                $message = "Your rating is already in product!";
                return redirect()->back()->with('error_message', $message);
            }else{
                if(empty($data['rating'])) {
                    $message = "Please add rating in product!";
                    return redirect()->back()->with('error_message', $message);
                } else {
                    $rating = new Rating;
                    $rating->user_id = $user_id;
                    $rating->product_id = $data['product_id'];
                    $rating->rating = $data['rating'];
                    $rating->review = $data['review'];
                    $rating->status = 1;
                    $rating->save();
                    $message = "Rating added succsesfully!";
                    return redirect()->back()->with('succses_message', $message);
                }
            }
        }
    }
}
