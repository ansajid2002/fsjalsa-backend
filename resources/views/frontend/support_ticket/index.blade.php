@extends('frontend.layouts.app')

@section('content')
<section class="gry-bg profile">
    <div class="container-fluid p-0">
        <div class="row cols-xs-space cols-sm-space cols-md-space p-0">
            <div class="col-lg-3 d-none d-lg-block" id="sidebarDiv">
                @if(Auth::user()->user_type == 'seller')
                    @include('frontend.inc.seller_side_nav')
                @elseif(Auth::user()->user_type == 'customer')
                    @include('frontend.inc.customer_side_nav')
                @endif
            </div>

            <div class="col-lg-9 content-card">
                <div class="main-content">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 d-flex align-items-center">
                                <a class="mainnav-toggle d-none d-lg-block" href="#" id="sidebarCollapse" style="margin: 2px;font-size: 30px;">
                                    <i class="la la-bars"></i>
                                </a>
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{ translate('Support Ticket')}}
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                        <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                        <li><a href="{{ route('support_ticket.index') }}">{{ translate('Support Ticket')}}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" data-toggle="modal" data-target="#ticket_modal">
                                <i class="la la-plus"></i>
                                <span class="d-block title heading-6 strong-400 c-base-1">{{  translate('Create a Ticket') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card no-border mt-4">
                        <table class="table table-sm table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th>{{ translate('Ticket ID') }}</th>
                                    <th>{{ translate('Sending Date') }}</th>
                                    <th>{{ translate('Subject')}}</th>
                                    <th>{{ translate('Status')}}</th>
                                    <th>{{ translate('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($tickets) > 0)
                                    @foreach ($tickets as $key => $ticket)
                                        <tr>
                                            <td>#{{ $ticket->code }}</td>
                                            <td>{{ $ticket->created_at }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>
                                                @if ($ticket->status == 'pending')
                                                    <span class="badge badge-pill badge-danger">{{ translate('Pending')}}</span>
                                                @elseif ($ticket->status == 'open')
                                                    <span class="badge badge-pill badge-secondary">{{ translate('Open')}}</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">{{ translate('Solved')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('support_ticket.show', encrypt($ticket->id))}}" class="btn btn-styled btn-link py-1 px-0 icon-anim text-underline--none">
                                                    {{ translate('View Details')}}
                                                    <i class="la la-angle-right text-sm"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center pt-5 h4" colspan="100%">
                                            <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                            <span class="d-block">{{  translate('No history found.') }}</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-wrapper py-4">
                        <ul class="pagination justify-content-end">
                            {{ $tickets->links() }}
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

<div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5">{{ translate('Create a Ticket')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('Subject')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="subject" placeholder="{{ translate('Subject') }}" required>
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Provide a detailed description')}} <span class="text-danger">*</span></label>
                        <textarea class="form-control editor" name="details" placeholder="{{ translate('Type your reply') }}" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-2" class=" mw-100 mb-0">
                            <i class="fa fa-upload"></i>
                            <span>{{ translate('Attach files.')}}</span>
                        </label>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('cancel')}}</button>
                        <button type="submit" class="btn btn-base-1">{{ translate('Send Ticket')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
