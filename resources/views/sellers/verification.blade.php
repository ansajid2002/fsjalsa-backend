@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <div class="panel-control">
            <a href="{{ route('sellers.reject', $seller->id) }}" class="btn btn-default btn-rounded d-innline-block">{{translate('Reject')}}</a></li>
            <a href="{{ route('sellers.approve', $seller->id) }}" class="btn btn-primary btn-rounded d-innline-block">{{translate('Accept')}}</a>
        </div>
        <h3 class="panel-title">{{translate('Seller Verification')}}</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-4">
            <div class="panel-heading">
                <h3 class="text-lg">{{translate('User Info')}}</h3>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Name')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->name }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Email')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->email }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Address')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->address }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Phone')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->phone }}</p>
                </div>
            </div>

            <div class="panel-heading">
                <h3 class="text-lg">{{translate('Document Link')}}</h3>
            </div>
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tbody>
                        <tr>
                            <th>{{translate('Company Photo')}}</th>
                            <td>@if($seller->company_photo !== null) <center><b><a href="/uploads/company_files/{{ $seller->company_photo }}" target="_blank">Link</a></b></center> @endif</td>
                        </tr>
                        <tr>
                            <th>{{translate('Company GST')}}</th>
                            <td>@if($seller->company_gst !== null) <center><b><a href="/uploads/company_gst/{{ $seller->company_gst }}" target="_blank">Link</a></b></center> @endif</td>
                        </tr>
                        <tr>
                            <th>{{translate('Company Pan')}}</th>
                            <td>@if($seller->company_pan !== null) <center><b><a href="/uploads/company_pan/{{ $seller->company_pan }}" target="_blank">Link</a></b></center> @endif</td>
                        </tr>
                        <tr>
                            <th>{{translate('Cancel Check')}}</th>
                            <td>@if($seller->cancel_cheque !== null) <center><b><a href="/uploads/blank_cheque/{{ $seller->cancel_cheque }}" target="_blank">Link</a></b></center> @endif</td>
                        </tr>
                </tbody>
            </table>

            {{-- 
                <div class="panel-heading">
                <h3 class="text-lg">{{translate('Shop Info')}}</h3>
            </div>

            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Shop Name')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->shop->name }}</p>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 control-label" for="name">{{translate('Address')}}</label>
                <div class="col-sm-9">
                    <p>{{ $seller->user->shop->address }}</p>
                </div>
            </div>
            --}}
        </div>
        <div class="col-md-4">
            <div class="panel-heading">
                <h3 class="text-lg">{{translate('Company details')}}</h3>
            </div>
    
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tbody>
                    @foreach (json_decode($seller->company_details) as $key => $info)
                        <tr>
                            <th>{{ ucfirst(str_replace("_", " ", $key)) }}</th>
                            <td>{{ $info }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="panel-heading">
                <h3 class="text-lg">{{translate('Shipping details')}}</h3>
            </div>
    
            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <tbody>
                    @foreach (json_decode($seller->shipping_details) as $key => $info)
                        <tr>
                            <th>{{ ucfirst(str_replace("_", " ", $key)) }}</th>
                            <td>{{ $info }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-body" style="margin-bottom: 10px">
        <div class="text-center">
            <a href="{{ route('sellers.reject', $seller->id) }}" class="btn btn-default d-innline-block">{{translate('Reject')}}</a></li>
            <a href="{{ route('sellers.approve', $seller->id) }}" class="btn btn-primary d-innline-block">{{translate('Accept')}}</a>
        </div>
    </div>
</div>

@endsection
