@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container-fluid p-0">
            <div class="row cols-xs-space cols-sm-space cols-md-space p-0">
                <div class="col-lg-3 d-none d-lg-block" id="sidebarDiv">
                    @include('frontend.inc.seller_side_nav')
                </div>

                <div class="col-lg-9 content-card card">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 d-flex align-items-center">
                                        <a class="mainnav-toggle d-none d-lg-block" href="#" id="sidebarCollapse" style="margin: 2px;font-size: 30px;">
                                            <i class="la la-bars"></i>
                                        </a>
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{ translate('Payment History')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('payments.index') }}">{{ translate('Payment History')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count($payments) > 0)
                            <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ translate('Date')}}</th>
                                                <th>{{ translate('Amount')}}</th>
                                                <th>{{ translate('Payment Method')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $key => $payment)
                                                <tr>
                                                    <td>
                                                        {{ $key+1 }}
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                                                    <td>
                                                        {{ single_price($payment->amount) }}
                                                    </td>
                                                    <td>
                                                        {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) ({{  translate('TRX ID') }} : {{ $payment->txn_code }}) @endif
                                                        </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $payments->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
