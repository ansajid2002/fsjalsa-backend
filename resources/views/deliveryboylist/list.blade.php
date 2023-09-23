
@extends('layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">Delivery Boy List and Details</h3>
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
      <div class="table-responsive">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                     <th class="text-center">#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Profile</th>
                      <th>Aadhar Pic</th>
                      <th>Lane</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Pincode</th>
                      <th>Driving License</th>
                      <th>Pan Card</th>
                      <th>Bank Name</th>
                      <th>Ifsc</th>
                      <th>Bank Account No</th>
                      <th>Work From - To</th>
                      <th>Status</th>
                </tr>
            </thead>
            <tbody>
              @if(count($delivery)>0)
             @php $i=1; @endphp
             @foreach($delivery as $del)
           <tr>
                <td class="text-center">{{$i}}</td>
                <td>{{$del->name}}</td>
                <td>{{$del->phone}}</td>
                <td>{{$del->email}}</td>
                <td><a target="_blank" href="{{url('public/register/deliveryboy/profile')}}/{{$del->pic}}" style="font-weight:bold;color:black">View Profile Pic</a></td>
                <td><a target="_blank" href="{{url('public/register/deliveryboy/aadhar')}}/{{$del->aadhar_pic}}" style="font-weight:bold;color:black">View Aadhar Card</a></td>
                <td>{{$del->house}} {{$del->building}} {{$del->street}}</td>
                <td>{{$del->city}}</td>
                <td>{{$del->state}}</td>
                <td>{{$del->pincode}}</td>
                <td>{{$del->dlc}}</td>
                <td>{{$del->pan}}</td>
                <td>{{$del->bankname}}</td>
                <td>{{$del->ifsc}}</td>
                <td>{{$del->bank_acc}}</td>
                <td>{{$del->work_from}} - {{$del->work_to}}</td>
                @if($del->del_ver == 0)
                <td><a href="/verifyDeliveryBoyDone/{{$del->user_id}}"><button class="btn btn-warning">pending</button></td>
                  @else
                <td><span class="btn btn-success">verified successfully</span></td>
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
      </div>
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
