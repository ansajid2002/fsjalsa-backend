@extends('frontend.layouts.app')

@section('content')
@php
    $customer_package = \App\CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
@endphp
    <form action="{!!route('payment.rozer')!!}" method="POST" id='rozer-pay' style="display: none;">
        <!-- Note that the amount is in paise = 50 INR -->
        <!--amount need to be in paisa-->
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ env('RAZOR_KEY') }}"
                data-amount={{$customer_package->amount}}
                data-buttontext=""
                data-name="{{ env('APP_NAME') }}"
                data-description="Classified Package Payment"
                data-image="{{ asset(\App\GeneralSetting::first()->logo) }}"
                data-prefill.name= {{ Auth::user()->name}}
                data-prefill.email= {{ Auth::user()->email}}
                data-theme.color="#ff7529">
        </script>
        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
    </form>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#rozer-pay').submit()
        });
    </script>
@endsection
