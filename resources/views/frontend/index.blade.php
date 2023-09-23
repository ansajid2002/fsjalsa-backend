@extends('frontend.layouts.app')
@section('content')
<style>

/* Float four columns side by side */
.column__cc {
  float: left;
  width: 33.3%;
  padding: 4px 10px;
}

/* Remove extra left and right margins, due to padding */
.row__cc {margin: 0 -3px;}

/* Clear floats after the columns */
.row__cc:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column__cc {
    width: 33.3%;
    display: block;
    margin-bottom: 1px;
  }
}

/* Style the counter cards */
.card__cc {
  /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);*/
  padding: 1px;
  background-color: white;
}
</style>
<style>
.mainer{
  color:#8095b8;
  margin-left: -25px;
  margin-right: -25px;
  display: flex;
  /*align-items: center;
  justify-content: center;*/
  overflow-x: scroll;
}

.icono >i{
  color:#8095b8;
  font-size: 36px;
  margin-left: auto;
  margin-right: auto;
}
/* Hide scrollbar for Chrome, Safari and Opera */
/*.mainer::-webkit-scrollbar {
  display: none;
}

.mainer {
  -ms-overflow-style: none;  
  scrollbar-width: none; 
}*/
.mainer::-webkit-scrollbar {
    width: 3px;
    height: 10px;
}
 
.mainer::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 13px;
}
 
.mainer::-webkit-scrollbar-thumb {
    border-radius: 13px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 

}
.icono{
  display: flex;
  flex-direction: column;
  text-align: center;
  cursor: pointer;
  width: 140px;
  padding-right:18px;
}
.icono >p{
  color:#8095b8;
  text-transform: uppercase;
}

.icono> p:hover{
  color:#fff
}
.carding {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 100%;
  height: auto;
  justify-content: center;
}

.carding:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.category-sidebar{
    overflow-y: scroll;
}

.category-sidebar::-webkit-scrollbar {
    width: 6px;
    height: 10px;
}
 
.category-sidebar::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 13px;
}
 
.category-sidebar::-webkit-scrollbar-thumb {
    border-radius: 13px;
    -webkit-box-shadow: inset 0 0 6px #2fb7ec; 
     background-color: #93e1ff;
}
</style>
   
  <section class="home-banner-area mb-0" style="justify-content:center;align-items:center">
      <div class="card col-lg-12 col-md-12 col-sm-12" style="background-color:white">
          <div class="card-body" style="margin-top:-5px;margin-bottom: -20px;">
            <div class="mainer">
            @foreach (\App\Category::all() as $key => $category)
            <div class="icono" style="width: 220px;">
              <a  href="{{url('/')}}/search?category={{ __($category->slug) }}"><div style="background: white; border-radius: 10px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
              <img src="{{url('/')}}/public/{{$category->banner}}" style="object-fit: contain;width: 100px;height: 80px;padding: 4px 4px;">
              <p style="padding-left: 8px;padding-right: 8px;color: white;background: #2fb7ec;border-bottom-right-radius: 10px;border-bottom-left-radius: 10px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);"><b>{{ __($category->name) }}</b></p>
              </div></a>
            </div>
            @endforeach
          </div>
        </div>
    </div>
  </section>
  
  <div class="carding" style="background:white">
    <section class="mb-4" style="">

      <div class="row no-gutters">

       
          @php
              $num_todays_deal = count(filter_products(\App\Product::where('published', 1)->where('todays_deal', 1 ))->get());
              $featured_categories = \App\Category::where('featured', 1)->get();
          @endphp

          <div class="col-lg-9 order-1 order-lg-0 @if(count($featured_categories) == 0) home-slider-full @endif">
              <div class="home-slide">
                  <div class="home-slide">
                      <div  class="slick-carousel" data-slick-arrows="true" data-slick-dots="true" data-slick-autoplay="true">
                          @foreach (\App\Slider::where('published', 1)->get() as $key => $slider)
                              <div class="" style="height:57vh;object-fit:contain">
                                  <a href="{{ $slider->link }}" target="_blank">
                                  <img class="d-block w-100 h-100 lazyload" src="{{ asset('frontend/images/placeholder-rect.jpg') }}" data-src="{{ asset($slider->photo) }}" alt="{{ env('APP_NAME')}} promo">
                                  </a>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>

        <div class="col-lg-3 position-static order-1 order-lg-0">
              <center>
                  <h6 style="color:#2fb7ec;text-transform:uppercase;padding-top: 10px;padding-bottom: 4px"><b>TOP SELLING</b></h6>
                </center>
          <div class="category-sidebar" style="margin-right: 20px;height:50vh;margin-top:-15px;">
              <div class="col-md-12">
                
                      <div class="top__selling_bar">
                        <div class="row__cc" style="height:50vh;"> 

                         @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(20)->get() as $key => $product)
                          <div class="column__cc">
                            <div class="card__cc">
                               
                                <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100">
                                                <img class="img-fit lazyload mx-auto" style="object-fit:contain;width:auto;height: 100px;" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                            </a>
              <p style="text-align:center;padding-left: 8px;padding-right: 8px;color: #2fb7ec;background: white;"><b><a href="{{ route('product', $product->slug) }}">{{ substr($product->name,0,4) }}...</a></b>
                  <span class="product-price strong-600">
                                                        {{ home_discounted_base_price($product->id) }}
                                                    </span>
              </p>
                            </div>
                          </div>
                          @endforeach
                           
                          </div>
                        </div>
                      </div>
                </div>
            </div>
          </div>


        </div>
    </section>
  </div>

    @php
        $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date)

    <section class="mb-4" style="padding-left: 2px;padding-right: 10px;">
        <!-- <div class="container"> -->
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix ">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        {{ translate('Flash Sale') }}
                    </h3>
                    <div class="flash-deal-box float-left">
                        <div class="countdown countdown--style-1 countdown--style-1-v1 " data-countdown-date="{{ date('m/d/Y', $flash_deal->end_date) }}" data-countdown-label="show"></div>
                    </div>
                    <ul class="inline-links float-right">
                        <li><a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="active">{{ translate('View More') }}</a></li>
                    </ul>
                </div>
                <div class="caorusel-box arrow-round gutters-5">
                    <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                    @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                        @php
                            $product = \App\Product::find($flash_deal_product->product_id);
                        @endphp
                         @if ($product != null && $product->published != 0)
                            <div class="caorusel-card">
                                <div class="product-card-2 card card-product shop-cards">
                                    <div class="card-body p-0">
                                        <div class="card-image">
                                            <a href="{{ route('product', $product->slug) }}" class="d-block">
                                                <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                            </a>
                                        </div>

                                        <div class="p-md-3 p-2">
                                            <div class="price-box">
                                                @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                @endif
                                                <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                            </div>
                                            <div class="star-rating star-rating-sm mt-1">
                                                {{ renderStarRating($product->rating) }}
                                            </div>
                                            <h2 class="product-title p-0">
                                                <a href="{{ route('product', $product->slug) }}" class=" text-truncate">{{ __($product->name) }}</a>
                                            </h2>
                                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                                    {{ translate('Club Point') }}:
                                                    <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </section>
    @endif

    <div class="mb-4" style="padding-left: 2px;padding-right: 10px;">
        <!-- <div class="container"> -->
            <div class="row gutters-10 mt-1">
                @foreach (\App\Banner::where('position', 1)->where('published', 1)->get() as $key => $banner)
                    <div class="col-lg-{{ 12/count(\App\Banner::where('position', 1)->where('published', 1)->get()) }}">
                        <div class="media-banner mb-3 mb-lg-0">
                            <a href="{{ $banner->url }}" target="_blank" class="banner-container">
                                <img src="{{ asset('frontend/images/placeholder-rect.jpg') }}" data-src="{{ asset($banner->photo) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        <!-- </div> -->
    </div>



    <div id="today_deals" style="padding-left: 2px;padding-right: 10px;">
      @if($num_todays_deal > 0)
      <section class="mb-4">
          <!-- <div class="container"> -->
              <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                  <div class="section-title-1 clearfix">
                      <h3 class="heading-5 strong-700 mb-0 float-left">
                      <span class="mr-4">{{ translate('Todays Deal') }}</span>
                        <span class="badge badge-danger">{{ translate('Hot') }}</span>
                      </h3>
                  </div>
                  <div class="caorusel-box arrow-round gutters-5">
                      <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                      @foreach (filter_products(\App\Product::where('published', 1)->where('todays_deal', '1'))->get() as $key => $product)
                          @if ($product != null)
                              <a href="{{ route('product', $product->slug) }}" class="d-block flash-deal-item">
                                  <div class="row no-gutters align-items-center">
                                      <div class="col">
                                          <div class="img">
                                              <img class="lazyload img-fit" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                          </div>
                                          <br>
                                              <div class="price">
                                                  <span class="d-block">{{ home_discounted_base_price($product->id) }}</span>
                                                  @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                      <del class="d-block"> {{ home_base_price($product->id) }}</del>
                                                  @endif
                                              </div>

                                      </div>

                                  </div>
                              </a>
                          @endif
                      @endforeach
                      </div>
                  </div>
              </div>
          <!-- </div> -->
      </section>
      @endif
    </div>

    <div id="section_featured" style="padding-left: 2px;padding-right: 10px;">

    </div>

    <div id="section_best_selling" style="padding-left: 2px;padding-right: 10px;">

    </div>

    <div id="section_home_categories" style="padding-left: 2px;padding-right: 10px;">

    </div>

    @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
        @php
            $customer_products = \App\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();
        @endphp
       @if (count($customer_products) > 0)
           <section class="mb-4">
               <!-- <div class="container"> -->
                   <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                       <div class="section-title-1 clearfix">
                           <h3 class="heading-5 strong-700 mb-0 float-left">
                               <span class="mr-4">{{ translate('Classified Ads') }}</span>
                           </h3>
                           <ul class="inline-links float-right">
                               <li><a href="{{ route('customer.products') }}" class="active">{{ translate('View More') }}</a></li>
                           </ul>
                       </div>
                       <div class="caorusel-box arrow-round">
                           <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                               @foreach ($customer_products as $key => $customer_product)
                                   <div class="product-card-2 card card-product my-2 mx-1 mx-sm-2 shop-cards shop-tech">
                                       <div class="card-body p-0">
                                           <div class="card-image">
                                               <a href="{{ route('customer.product', $customer_product->slug) }}" class="d-block">
                                                   <img class="img-fit lazyload mx-auto" src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($customer_product->thumbnail_img) }}" alt="{{ __($customer_product->name) }}">
                                               </a>
                                           </div>

                                           <div class="p-sm-3 p-2">
                                               <div class="price-box">
                                                   <span class="product-price strong-600">{{ single_price($customer_product->unit_price) }}</span>
                                               </div>
                                               <h2 class="product-title p-0 text-truncate-1">
                                                   <a href="{{ route('customer.product', $customer_product->slug) }}">{{ __($customer_product->name) }}</a>
                                               </h2>
                                               <div>
                                                   @if($customer_product->conditon == 'new')
                                                       <span class="product-label label-hot">{{translate('new')}}</span>
                                                   @elseif($customer_product->conditon == 'used')
                                                       <span class="product-label label-hot">{{translate('Used')}}</span>
                                                   @endif
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
               <!-- </div> -->
           </section>
       @endif
   @endif

    <div class="mb-4" style="padding-left: 2px;padding-right: 10px;">
        <!-- <div class="container"> -->
            <div class="row gutters-10">
                @foreach (\App\Banner::where('position', 2)->where('published', 1)->get() as $key => $banner)
                    <div class="col-lg-{{ 12/count(\App\Banner::where('position', 2)->where('published', 1)->get()) }}">
                        <div class="media-banner mb-3 mb-lg-0">
                            <a href="{{ $banner->url }}" target="_blank" class="banner-container">
                                <img src="{{ asset('frontend/images/placeholder-rect.jpg') }}" data-src="{{ asset($banner->photo) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        <!-- </div> -->
    </div>

    <div id="section_best_sellers">

    </div>

    <section class="mb-3" style="padding-left: 2px;padding-right: 15px;">
        <!-- <div class="container"> -->
            <div class="row gutters-10">
                <div class="col-lg-6">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-left">
                            <span class="mr-4">{{translate('Top 10 Catogories')}}</span>
                        </h3>
                        <ul class="float-right inline-links">
                            <li>
                                <a href="{{ route('categories.all') }}" class="active">{{translate('View All Catogories')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row gutters-5">
                        @foreach (\App\Category::where('top', 1)->get() as $category)
                            <div class="mb-3 col-6">
                                <a href="{{ route('products.category', $category->slug) }}" class="bg-white border d-block c-base-2 box-2 icon-anim pl-2">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col-3 text-center">
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($category->banner) }}" alt="{{ __($category->name) }}" class="img-fluid img lazyload">
                                        </div>
                                        <div class="info col-7">
                                            <div class="name text-truncate pl-3 py-4">{{ __($category->name) }}</div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <i class="la la-angle-right c-base-1"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-left">
                            <span class="mr-4">{{translate('Top 10 Brands')}}</span>
                        </h3>
                        <ul class="float-right inline-links" style="padding-right: 10px;">
                            <li>
                                <a href="{{ route('brands.all') }}" class="active">{{translate('View All Brands')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row gutters-5">
                        @foreach (\App\Brand::where('top', 1)->get() as $brand)
                            <div class="mb-3 col-6">
                                <a href="{{ route('products.brand', $brand->slug) }}" class="bg-white border d-block c-base-2 box-2 icon-anim pl-2">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col-3 text-center">
                                            <img src="{{ asset('frontend/images/placeholder.jpg') }}" data-src="{{ asset($brand->logo) }}" alt="{{ __($brand->name) }}" class="img-fluid img lazyload">
                                        </div>
                                        <div class="info col-7">
                                            <div class="name text-truncate pl-3 py-4">{{ __($brand->name) }}</div>
                                        </div>
                                        <div class="col-2 text-center">
                                            <i class="la la-angle-right c-base-1"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                slickInit();
            });
        });
    </script>

@endsection
