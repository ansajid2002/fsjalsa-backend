<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Product;
use Auth;
use DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reviews = Review::orderBy('created_at', 'desc')->paginate(15);
        return view('reviews.index', compact('reviews'));
    }

    public function getSingleReview($id)
    {
        $reviews = Review::where('id', $id)->get();
        return $reviews;
    }

    public function updateUserReview(Request $request)
    {
        $update = DB::table('reviews')->where('id',$request->id)
                                      ->update([
                                        'rating'=>$request->rating,
                                        'comment'=>$request->comment,
                                      ]);

        if($update){
            flash('Review has been updated successfully')->success();
            return back();
        }else{
            flash('Something went wrong Try again')->success();
            return back();
        }
    }

    public function addOutsideUser()
    {
       $user_email = DB::table('outside_user')->where('email','!=',"")->get();
       $user_mobile = DB::table('outside_user')->where('phone','!=',"")->get();
       return view('reviews.outside_user', compact('user_email','user_mobile'));
    }

    public function addOutsideUserYes(Request $req)
    {
            if($req->type == "email"){
               $user = DB::table('outside_user')->insert([
                    'email'=>$req->email,
               ]);
           }else if($req->type == "mobile"){
               $user = DB::table('outside_user')->insert([
                    'phone'=>$req->mobile,
               ]);
           }
           if($user){
                    flash('User has been added successfully')->success();
                    return back();
                }else{
                    flash('Something went wrong Try again')->success();
                    return back();
                }
    }
    public function deleteOutsideUser($id)
    {
           $delete_user = DB::table('outside_user')->where('id',$id)->delete();
           if($delete_user){
                    flash('User has been delete successfully')->success();
                    return back();
                }else{
                    flash('Something went wrong Try again')->success();
                    return back();
                }
    }

    public function seller_reviews()
    {
        $reviews = DB::table('reviews')
                    ->orderBy('id', 'desc')
                    ->join('products', 'reviews.product_id', '=', 'products.id')
                    ->where('products.user_id', Auth::user()->id)
                    ->select('reviews.id')
                    ->distinct()
                    ->paginate(9);

        foreach ($reviews as $key => $value) {
            $review = \App\Review::find($value->id);
            $review->viewed = 1;
            $review->save();
        }

        return view('frontend.seller.reviews', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = DB::table('reviews')->where('id',Auth::user()->id)->where('user_id',$request->product_id)->get();
        if(count($query) > 0){
            DB::table('reviews')->where('id',Auth::user()->id)->where('user_id',$request->product_id)->insert([
                'rating'=>$request->rating,
                'comment'=> $request->comment
            ]);
            flash('Review has been updated successfully')->success();
            return back();
        }else{
        $review = new Review;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->viewed = '0';
        if($review->save()){
            $product = Product::findOrFail($request->product_id);
            if(count(Review::where('product_id', $product->id)->where('status', 1)->get()) > 0){
                $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/count(Review::where('product_id', $product->id)->where('status', 1)->get());
            }
            else {
                $product->rating = 0;
            }
            $product->save();
            flash('Review has been submitted successfully')->success();
            return back();
        }
        flash('Something went wrong')->error();
        return back();
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePublished(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $review->status = $request->status;
        if($review->save()){
            $product = Product::findOrFail($review->product->id);
            if(count(Review::where('product_id', $product->id)->where('status', 1)->get()) > 0){
                $product->rating = Review::where('product_id', $product->id)->where('status', 1)->sum('rating')/count(Review::where('product_id', $product->id)->where('status', 1)->get());
            }
            else {
                $product->rating = 0;
            }
            $product->save();
            return 1;
        }
        return 0;
    }
}
