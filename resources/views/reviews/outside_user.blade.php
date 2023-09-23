@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <!-- <a href="{{ route('sellers.create')}}" class="btn btn-info pull-right">{{translate('add_new')}}</a> -->
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Outside Customers Email Id')}}</h3>
        <div class="pull-right clearfix">
            <button class="btn btn-md" style="background: #093880;color: white" data-toggle="modal" data-target="#exampleModal"><b>+ Add</b></button>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Email Address')}}</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user_email as $em)
                    @if ($em->id != null)
                        <tr>
                            <td>{{$em->id}}</td>
                            <td>{{$em->email}}</td>
                            <td><a href="deleteOutsideUser/{{$em->id}}"><i class="fa fa-trash" style="color: red;cursor: pointer;"></i></a></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Outside Customers Mobile Number')}}</h3>
        <div class="pull-right clearfix">
            <button class="btn btn-md" style="background: #093880;color: white" data-toggle="modal" data-target="#exampleModal1"><b>+ Add</b></button>
        </div>
    </div>
     <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Mobile Number')}}</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user_mobile as $em)
                    @if ($em->id != null)
                        <tr>
                            <td>{{$em->id}}</td>
                            <td>{{$em->phone}}</td>
                            <td><a href="deleteOutsideUser/{{$em->id}}"><i class="fa fa-trash" style="color: red;cursor: pointer;"></i></a></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form method="post" action="add-outside-user">
                @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="hidden" name="type" value="email">
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required="">
                   
                  </div>
                  <button type="submit" class="btn btn-md" style="color: white;background:#093880 ">Submit</button>
            </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Mobile Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="add-outside-user">
             @csrf
            <input type="hidden" name="type" value="mobile">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <input type="number" class="form-control" name="mobile" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Mobile Number" required="">
                  </div>
                  <button type="submit" class="btn btn-md" style="color: white;background:#093880 ">Submit</button>
            </form>
      </div>
    </div>
  </div>
</div>
@endsection
