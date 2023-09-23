@extends('layouts.app')

@section('content')

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
    	<div class="panel-body">
    		<div class="invoice-masthead">
    			<div class="invoice-text">
    				<h3 class="h1 text-thin mar-no text-primary">{{ translate('Order Details') }}</h3>

    			</div>
    		</div>

    		<div class="invoice-bill row">
    			<div class="col-sm-6 text-xs-center">
    				<address>
        				<strong class="text-main">{{ json_decode($order->shipping_address)->name }}</strong><br>
                         {{ json_decode($order->shipping_address)->email }}<br>
                         {{ json_decode($order->shipping_address)->phone }}<br>
        				 {{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->postal_code }}<br>
                         {{ json_decode($order->shipping_address)->country }}
                    </address>

    			</div>
    			<div class="col-sm-6 text-xs-center">
    				<table class="invoice-details">
    				<tbody>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Order #')}}
    					</td>
    					<td class="text-right text-info text-bold">
    						{{ $order->code }}
    					</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Order Status')}}
    					</td>
                        @php
                            $status = \App\OrderDetail::where('order_id', $order->id)->first();
                        @endphp
    					<td class="text-right">
                            @if($status->delivery_status == 'delivered')
                                <span class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $status->delivery_status)) }}</span>
                            @else
                                <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $status->delivery_status)) }}</span>
                            @endif
    					</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Order Date')}}
    					</td>
    					<td class="text-right">
    						{{ date('d-m-Y h:i A', $order->date) }} (UTC)
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{translate('Total amount')}}
    					</td>
    					<td class="text-right">
                @php
                $tax = \App\OrderDetail::where('order_id', $order->id)->sum('tax');
                @endphp
    						{{ single_price($order->grand_total + $tax) }}
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{translate('Payment method')}}
    					</td>
    					<td class="text-right">
    						{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
    					</td>
    				</tr>

                    <tr>
                      <td class="text-main">
                      </td>
                      	<td class="text-right">
                        </td>
                    </tr>
                    <tr>

    					<td class="text-main">

                <a href="/deliveryDoneDeliveryBoy/{{$order->id}}"><span class="btn btn-sm btn-danger">Delivery Done?</span></a>
                <p>
                <span><small style="color:black">if yes click on delivery done</small></span>
                </p>


    					</td>
    					<td class="text-right">
                @if($order->payment_status == "paid")
                <span class="btn btn-sm btn-primary">Paid</span>
                <p>
                <span><small style="color:black">customer has paid</small></span>
                </p>
                @else
                <a href="/cashCollectedDeliveryBoy/{{$order->id}}"><span class="btn btn-sm btn-primary">Cash Collected?</span></a>
                <p>
                <span><small>if yes click on cash collected</small></span>
                </p>
                @endif
    					</td>
    				</tr>
    				</tbody>
    				</table>
    			</div>
    		</div>

    		<hr class="new-section-sm bord-no">
    		<div class="row">
          <div class="col-lg-12 table-responsive">
    				<table class="table table-bordered invoice-summary">
        				<thead>
            				<tr class="">
                    <th class="min-col">  #</th>

            					<th class="text-uppercase">
            						{{translate('Description')}}
            					</th>
            					<th class="min-col text-center text-uppercase">
            						{{translate('Qty')}}
            					</th>
            				</tr>
        				</thead>
        				<tbody>

                @foreach (\App\OrderDetail::where('order_id', $order->id)->get() as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>

                					<td>
                                        @if ($orderDetail->product != null)
                    						<strong><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a></strong>
                    						<small>{{ $orderDetail->variation }}</small>
                                        @else
                                            <strong>{{ translate('Product Unavailable') }}</strong>
                                        @endif
                					</td>

                					<td class="text-center">
                						{{ $orderDetail->quantity }}
                					</td>
                				</tr>
                            @endforeach
        				</tbody>
    				</table>
    			</div>
    		</div>
    		<div class="clearfix">
          <table class="table invoice-total">
    			<tbody>
    			<tr>
    				<td>
    					<strong>{{translate('Sub Total')}} :</strong>
    				</td>
    				<td>
    					{{ single_price($order->grand_total) }}
    				</td>
    			</tr>
          <tr>
    				<td>
    					<strong>{{translate('Tax')}} :</strong>
    				</td>
    				<td>
    					{{ $tax }}
    				</td>
    			</tr>
                <tr>
    				<td>
    					<strong>{{translate('Shipping')}} :</strong>
    				</td>
             @php
             $gst = \App\OrderDetail::where('order_id', $order->id)->sum('shipping_cost');
             @endphp
    				<td>
    					{{ single_price($gst) }}
    				</td>
    			</tr>
    			<tr>
    				<td>
    					<strong>{{translate('TOTAL')}} :</strong>
    				</td>
    				<td class="text-bold h4">
    					{{ single_price( $order->grand_total + $tax + $gst) }}
    				</td>
    			</tr>
    			</tbody>
    			</table>
    		</div>
        <?php
        $stri = json_decode($order->shipping_address)->address." ".json_decode($order->shipping_address)->city." ".json_decode($order->shipping_address)->postal_code." ".json_decode($order->shipping_address)->country;
        $main = str_replace(' ',"%20",$stri);
        ?>
        <div>
          <h4><center>View Location on Map</center></h4>
        </div>
        <div style="width: 100%" class="col-md-6 offset-md-3">
          <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{$main}}+()&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
          </iframe><a href="https://www.mapsdirections.info/en/measure-map-radius/">Map radius measure</a></div>
    	</div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#update_delivery_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Delivery status has been updated');
            });
        });
        $('#update_delivery_boy').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_boy').val();
            $.post('{{ route('orders.update_delivery_boy') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Delivery Boy has been Assigned');
            });
        });

        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Payment status has been updated');
            });
        });
    </script>
@endsection
