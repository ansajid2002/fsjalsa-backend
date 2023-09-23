<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\User;
use App\Shop;
use App\Product;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $approved = null;
        $sellers = Seller::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'seller')->where(function($user) use ($sort_search){
                $user->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            })->pluck('id')->toArray();
            $sellers = $sellers->where(function($seller) use ($user_ids){
                $seller->whereIn('user_id', $user_ids);
            });
        }
        if ($request->approved_status != null) {
            $approved = $request->approved_status;
            $sellers = $sellers->where('verification_status', $approved);
        }
        $sellers = $sellers->paginate(15);
        return view('sellers.index', compact('sellers', 'sort_search', 'approved'));
    }

    public function registration(Request $request)
    {
       /*  if(Auth::check()){
            return redirect()->route('home');
        }
        if($request->has('referral_code')){
            Cookie::queue('referral_code', $request->referral_code, 43200);
        } */
        return view('frontend.seller_registration');
    }
    public function accountVerification(Request $request)
    {

        return view('frontend.account_verfication_in_progress');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(User::where('email', $request->email)->first() != null){
            flash(__('Email already exists!'))->error();
            return back();
        }
        $user = new User;
      
        $user->phone = $request->mobile;
        $user->email = $request->email;
        // $user->name = $request->name;
        $user->name = "Seller";
        $user->user_type = "seller";
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->country = $request->nation;
        $user->city = $request->city;
        $user->postal_code = $request->pin_code;
        
        if($user->save()){
            $seller = new Seller;
            $seller->user_id = $user->id;

            $seller->company_details = json_encode([
                'gst_number' => $request->gstin,
                'company_pan_number' => $request->cmp_pan_number,
                'company_name' => $request->cmp_name,
                'legal_name' => $request->legal_name,
                'address' => $request->address,
                'pincode' => $request->pin_code,
                'city' => $request->city,
                'state' => $request->state
            ]);
            if ($request->hasFile('cmp_file')) {
                $seller->company_photo = $this->uploadFiles($request, 'cmp_file', 'uploads/company_files');
            }        
            if ($request->hasFile('cmp_gst')) {
                $seller->company_gst = $this->uploadFiles($request, 'cmp_gst', 'uploads/company_gst');
            }        
            if ($request->hasFile('cmp_pan')) {
                $seller->company_pan = $this->uploadFiles($request, 'cmp_pan', 'uploads/company_pan');
            }
            $seller->shipping_details = json_encode([
                'shipping_city' => $request->ship_city,
                'shipping_pincode' => $request->ship_pin_code,
                'address' => $request->address2,
                'shipping_state' => $request->ship_state,
                'nation' => $request->nation,
            ]);
            $seller->bank_acc_name = $request->account_holder_name;
            $seller->bank_acc_no = $request->bank_acc_no;
            $seller->ifsc_code = $request->ifsc_code;
            $seller->bank_acc_type = $request->bank_acc_type;

            if ($request->hasFile('bank_chq')) {
                $seller->cancel_cheque = $this->uploadFiles($request, 'bank_chq', 'uploads/blank_cheque');

            } 

            if($seller->save()){
                flash(__('Seller registered successfully'))->success();
                $shop = new Shop;
                $shop->user_id = $user->id;
                $shop->slug = 'demo-shop-'.$user->id;
                $shop->save();
                return redirect()->route('user.login');
            }
            flash(__('Seller registered successfully'))->success();
        }

        else{
            flash(__('Something went wrong'))->error();
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
        $seller = Seller::findOrFail(decrypt($id));
        return view('sellers.edit', compact('seller'));
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
        $seller = Seller::findOrFail($id);
        $user = $seller->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if(strlen($request->password) > 0){
            $user->password = Hash::make($request->password);
        }
        if($user->save()){
            if($seller->save()){
                flash(__('Seller has been updated successfully'))->success();
                return redirect()->route('sellers.index');
            }
        }

        flash(__('Something went wrong'))->error();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        Shop::where('user_id', $seller->user->id)->delete();
        Product::where('user_id', $seller->user->id)->delete();
        Order::where('user_id', $seller->user->id)->delete();
        OrderDetail::where('seller_id', $seller->user->id)->delete();
        User::destroy($seller->user->id);
        if(Seller::destroy($id)){
            flash(__('Seller has been deleted successfully'))->success();
            return redirect()->route('sellers.index');
        }
        else {
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function show_verification_request($id)
    {
        $seller = Seller::findOrFail($id);
        return view('sellers.verification', compact('seller'));
    }

    public function approve_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 1;
        if($seller->save()){
            flash(__('Seller has been approved successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(__('Something went wrong'))->error();
        return back();
    }

    public function reject_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 0;
        $seller->verification_info = null;
        if($seller->save()){
            flash(__('Seller verification request has been rejected successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(__('Something went wrong'))->error();
        return back();
    }


    public function payment_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view('sellers.payment_modal', compact('seller'));
    }

    public function profile_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view('sellers.profile_modal', compact('seller'));
    }

    public function updateApproved(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        $seller->verification_status = $request->status;
        if($seller->save()){
            return 1;
        }
        return 0;
    }

    public function login($id)
    {
        $seller = Seller::findOrFail(decrypt($id));

        $user  = $seller->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function uploadFiles($request, $inputFileName, $path)
    {
        $filenameWithExt = $request->file($inputFileName)->getClientOriginalName();      
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);       
        $extension = $request->file($inputFileName)->getClientOriginalExtension();       
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path2 = $request->file($inputFileName)->move($path, $fileNameToStore);
        return $fileNameToStore;
    }
}
