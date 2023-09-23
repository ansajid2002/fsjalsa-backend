@extends('layouts.app')

@section('content')
<center><h2>Development In Progress</h2></center>
@if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-danger pad-all text-center mar-btm">
                <h4 class="text-light mar-btm">{{translate('Please Configure SMTP Setting to work all email sending funtionality')}}.</h4>
                <a class="btn btn-info btn-rounded" href="{{ route('smtp_settings.index') }}">Configure Now</a>
            </div>
        </div>
    </div>
@endif
@if(true === false && (Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))))
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Today Sell')}}</p>
                        <p class="text-semibold text-3x text-main">Rs {{ \DB::table('orders')->where('created_at',date('Y-m-d'))->sum('grand_total') }}</p>
                        
                    </div>
                </div>
            </div> <div class="col-sm-2">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('New Order')}}</p>
                        <p class="text-semibold text-3x text-main">
                            {{ 
                                \DB::table('order_details')
                                ->whereIn('delivery_status',array('pending'))
                                ->distinct('order_id')
                                ->count('order_id') 
                            }}
                        </p>
                        
                    </div>
                </div>
            </div>
             <div class="col-sm-2">    
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Process Order')}}</p>
                        <p class="text-semibold text-3x text-main">
                            {{ 
                                \DB::table('order_details')
                                ->whereIn('delivery_status',array('on_delivery','on_review'))
                                ->distinct('order_id')
                                ->count('order_id') 
                            }}
                        </p>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Complete Order')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \DB::table('order_details')->where('delivery_status',"delivered")->distinct('order_id')->count('order_id') }}</p>
                       
                    </div>
                </div>
            </div>
             <div class="col-sm-3">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Monthly Sell')}}</p>
                        <p class="text-semibold text-3x text-main">Rs {{ \DB::table('orders')->whereYear('created_at', \Carbon\Carbon::now()->year)
                        ->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('grand_total') }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(true === false && (Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))))
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel"  style="border-radius: 999px;">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\Category::all()->count() }}</p>
                        
                    </div>
                </div>
            </div>
             <div class="col-sm-3">    
                <div class="panel"  style="border-radius: 999px;">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product sub sub category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\SubSubCategory::all()->count() }}</p>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel"  style="border-radius: 999px;">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product sub category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\SubCategory::all()->count() }}</p>
                       
                    </div>
                </div>
            </div>
             <div class="col-sm-3">
                <div class="panel"  style="border-radius: 999px;">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product brand')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\Brand::all()->count() }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(true === false && (Auth::user()->user_type == 'admin' || in_array('5', json_decode(Auth::user()->staff->role->permissions))) && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
    <div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('SELLERS')}}</div>
                </div>
                <br>
                <p class="text-normal text-main">{{translate('Total sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::all()->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total approved sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::where('verification_status', 1)->get()->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total pending sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::where('verification_status', 0)->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
@endif

@if(true === false && (Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))))
    <div class="row">
    <div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Category wise product sale')}}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th>{{translate('Category Name')}}</th>
                                <th>{{translate('Sale')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Category::all() as $key => $category)
                                <tr>
                                    <td>{{ __($category->name) }}</td>
                                    <td>{{ \App\Product::where('category_id', $category->id)->sum('num_of_sale') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Category wise product stock')}}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th>{{translate('Category Name')}}</th>
                                <th>{{translate('Stock')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Category::all() as $key => $category)
                                @php
                                    $products = \App\Product::where('category_id', $category->id)->get();
                                    $qty = 0;
                                    foreach ($products as $key => $product) {
                                        if ($product->variant_product) {
                                            foreach ($product->stocks as $key => $stock) {
                                                $qty += $stock->qty;
                                            }
                                        }
                                        else {
                                            $qty = $product->current_stock;
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>{{ __($category->name) }}</td>
                                    <td>{{ $qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif



@endsection
