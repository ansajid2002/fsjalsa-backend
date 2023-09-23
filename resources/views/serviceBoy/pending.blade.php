
@extends('layouts.app')

@section('content')
<style>
.column {
  float: left;
  width: 50%;
  padding: 0 10px;
  margin-bottom:12px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
</style>
<div class="panel">
  @if (session()->has('success'))
  <div class="alert alert-success">
  @if(is_array(session()->get('success')))
          <ul>
              @foreach (session()->get('success') as $message)
                  <li>{{ $message }}</li>
              @endforeach
          </ul>
          @else
              {{ session()->get('success') }}
          @endif
      </div>
  @endif
   @if (count($errors) > 0)
    @if($errors->any())
      <div class="alert alert-danger" role="alert">
        {{$errors->first()}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    @endif
  @endif
    <div class="panel-heading bord-btm clearfix pad-all h-100">

        <h3 class="panel-title pull-left pad-no">Pending Order For Delivery</h3>

    </div>
    <div class="panel-body">

            <div class="row">
             @foreach($deliveryOrder as $orderDel)
             @php
             $del_stat_view =  \App\OrderDetail::where('order_id', $orderDel->id)->first();
             @endphp
             @if($del_stat_view->delivery_status !="delivered")
              <div class="column">
                <div class="card">
                  <div class="row">
                    <div class="col-md-6" style="justify-content:center">
                    @php $dc = json_decode($orderDel->shipping_address);@endphp
                    <b>Order Date: {{date("d-m-Y",strtotime($orderDel->created_at))}}</b><br>
                    {{$dc->name}},<br>
                    {{$dc->email}},<br>
                    {{$dc->phone}},<br>
                    {{$dc->address}}, {{$dc->city}}, {{$dc->country}}<br>
                    {{$dc->postal_code}}
                    <br>
                    <br>

                    </div>
                    <div class="col-md-6">
                      <div>
                        <img style="height:40px;object-fit:content" src="https://www.clipartmax.com/png/full/173-1730336_food-items-food-products-icon-png.png" />
                        <br>
                        Order Id #{{$orderDel->code}}<br>
                        @php
                        $order_detail =  \App\OrderDetail::where('order_id', $orderDel->id)->get();
                        @endphp
                        Total Items #{{count($order_detail)}}<br>
                        <a href="/deliveryboy/order/pending/view/{{$orderDel->id}}"><button class="btn btn-sm btn-warning">View Detail</button></a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
               @endif
              @endforeach

           </div>

    </div>
</div>
@endsection


@section('script')

@endsection
