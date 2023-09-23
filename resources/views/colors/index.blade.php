@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('colors.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Color')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Colors')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_color" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
    <table class="table table-striped table-bordered " id="colorTable" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Code')}}</th>
                    <th>{{translate('Color')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colors as $key => $color)
                    <tr>
                    <td>{{ ($key+1) + ($colors->currentPage() - 1)*$colors->perPage() }}</td>
                        <td>{{__($color->name)}}</td>
                        <td>{{__($color->code)}}</td>
                        <td><span style="background-color:{{__($color->code)}}; display: list-item;"></span></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('colors.edit', encrypt($color->id))}}">{{translate('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('colors.destroy', $color->id)}}');">{{translate('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $colors->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection


