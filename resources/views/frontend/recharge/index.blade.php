@extends('layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">Recharge Detail & Report</h3>
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
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                     <th class="text-center">#</th>
                      <th>User Name</th>
                      <th>Payment Order Id</th>
                      <th>Payment Id</th>
                      <th>Payment Status</th>
                      <th>Recharge Status</th>
                      <th>Operator</th>
                      <th>Circle</th>
                      <th>Type</th>
                      <th>Mobile No</th>
                      <th>Recharge Amount</th>
                      <th>Field1</th>
                      <th>Field2</th>
                      <th>Recharge Request Id</th>
                      <th>Payment Signature</th>
                      <th>Remark</th>
                      <th>Refund</th>
                </tr>
            </thead>
            <tbody>
              @if(count($data)>0)
             @php $i=1; @endphp
             @foreach($data as $ords)
           <tr>
                <td class="text-center">{{$i}}</td>
                <td>{{$ords->name}}</td>
                <td>{{$ords->razorpay_order_id}}</td>
                <td>{{$ords->razorpay_payment_id}}</td>
                <td>{{$ords->payment_status}}</td>
                @if($ords->recharge_status == "FAILED")
                <td style="color:red">{{$ords->recharge_status}}</td>
                @else
                  <td style="color:green">{{$ords->recharge_status}}</td>
                @endif
                <td>{{$ords->operator}}</td>
                <td>{{$ords->circle}}</td>
                <td>{{$ords->type}}</td>
                <td>{{$ords->mobile_no}}</td>
                <td>Rs. {{$ords->recharge_amount}}</td>
                <td>{{$ords->field1}}</td>
                <td>{{$ords->field2}}</td>
                <td>{{$ords->reqid}}</td>
                  <td>{{$ords->razorpay_signature}})</td>
                <td>{{$ords->remark}}</td>

                @if($ords->recharge_status == "FAILED")
                 @if($ords->payment_status == "success")
                  @if($ords->refund_status == 0)
                <td><a href="/refundUser/{{$ords->id}}"><button class="btn btn-primary">Refund</button></td>
                  @else
                   <td>refund id: {{$ords->refund_id}}<br>status: {{$ords->refunding_status}}</td>
                  @endif
                 @endif
               @else
               @endif
           </tr>
             @php $i++; @endphp
                    @endforeach
                     @else
                       <tr>
                         <td>No data found</td>
                       </tr>
                     @endif
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">

            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
@endsection
