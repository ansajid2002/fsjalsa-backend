@extends('layouts.app')

@section('content')

@if($type != 'Seller')
    <div class="row">
        <div class="col-lg-12 pull-right">
            <a href="{{ route('products.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New Product')}}</a>
        </div>
    </div>
@endif

<br>

<div class="panel">
    <!--Panel heading-->
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{ translate($type.' Products') }}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_products" action="" method="GET">
                @if($type == 'Seller')
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 200px;">
                            <select class="form-control demo-select2" id="user_id" name="user_id" onchange="sort_products()">
                                <option value="">All Sellers</option>
                                @foreach (App\Seller::all() as $key => $seller)
                                    @if ($seller->user != null && $seller->user->shop != null)
                                        <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>{{ $seller->user->shop->name }} ({{ $seller->user->name }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 200px;">
                        <select class="form-control demo-select2" name="type" id="type" onchange="sort_products()">
                            <option value="">Sort by</option>
                            <option value="rating,desc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{translate('Rating (High > Low)')}}</option>
                            <option value="rating,asc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{translate('Rating (Low > High)')}}</option>
                            <option value="num_of_sale,desc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{translate('Num of Sale (High > Low)')}}</option>
                            <option value="num_of_sale,asc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{translate('Num of Sale (Low > High)')}}</option>
                            <option value="unit_price,desc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{translate('Base Price (High > Low)')}}</option>
                            <option value="unit_price,asc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{translate('Base Price (Low > High)')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type & Enter') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="20%">{{translate('Name')}}</th>
                    @if($type == 'Seller')
                        <th>{{translate('Seller Name')}}</th>
                    @endif
                    <th>{{translate('Num of Sale')}}</th>
                    <th>{{translate('Total Stock')}}</th>
                    <th>{{translate('Base Price')}}</th>
                    <!-- <th>{{translate('Todays Deal')}}</th> -->
                    <!-- <th>{{translate('Rating')}}</th> -->
                    <!-- <th>{{translate('Published')}}</th> -->
                    <th width="10%">{{translate('Status')}}</th>
                    <th>{{translate('Reason')}}</th>
                    <!-- <th>{{translate('Featured')}}</th> -->
                    <th>{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                        <td>
                            <a href="{{ route('product', $product->slug) }}" target="_blank" class="media-block">
                                <div class="media-left">
                                    <img loading="lazy"  class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image">
                                </div>
                                <div class="media-body">{{ __($product->name) }}</div>
                            </a>
                        </td>
                        @if($type == 'Seller')
                            <td>{{ $product->user->name }}</td>
                        @endif
                        <td>{{ $product->num_of_sale }} {{translate('times')}}</td>
                        <td>
                            @php
                                $qty = 0;
                                if($product->variant_product){
                                    foreach ($product->stocks as $key => $stock) {
                                        $qty += $stock->qty;
                                    }
                                }
                                else{
                                    $qty = $product->current_stock;
                                }
                                echo $qty;
                            @endphp
                        </td>
                        <td>{{ number_format($product->unit_price,2) }}</td>
                        <!-- <td><label class="switch">
                                <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->todays_deal == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td> -->
                        <!-- <td>{{ $product->rating }}</td> -->
                        <!-- <td><label class="switch">
                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td> -->
                                <!--  -->
                            <td width="10%">
                            <select  id="status" name="status" required="" data-id="{{ $product->id }}" class="form-control demo-select2-placeholder select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="0"  @if($product->published == 0) selected @endif>Pending</option>
                            <option value="2"  @if($product->published == 2) selected @endif>In review</option>
                            <option value="1"  @if($product->published == 1) selected @endif>Published</option>
                            <option value="4"  @if($product->published == 4) selected @endif>Unpublished</option>
                            <a href=""><option value="3"  @if($product->published == 3) selected @endif>Reject</option></a>
                            </select>
                        <!-- <label class="switch">

                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                                <span class="slider round"></span></label> -->
                            </td>
                            <td>
                                <span onclick="update_product_reason(this)" value="{{ $product->id }}" >{{ $product->reject_reason }}</span>
                            </td>

                        <!-- <td><label class="switch">
                                <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->featured == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td> -->
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if ($type == 'Seller')
                                        <li><a href="{{route('products.seller.edit', encrypt($product->id))}}">{{translate('Edit')}}</a></li>
                                    @else
                                        <li><a href="{{route('products.admin.edit', encrypt($product->id))}}">{{translate('Edit')}}</a></li>
                                    @endif
                                    <li><a onclick="confirm_modal('{{route('products.destroy', $product->id)}}');">{{translate('Delete')}}</a></li>
                                    <li><a href="{{route('products.duplicate', $product->id)}}">{{translate('Duplicate')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
        
    </div>
</div>
<div class="modal fade" id="reasonModal" data-target="#reasonMoal">
<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
            </div>
            <div class="modal-body">
            <form role="form" id="formfield" action="" method="get"  enctype="multipart/form-data">

                <div class="form-group">
                    <h4 class="modal-title"><strong>Reason</strong></h4>
                    <br>
				    <input type="text" class="form-control" name="reason" id="reason" placeholder="Reason" required="">
                    
                    <input type="hidden" id="hidereson">
                    <input type="hidden" id="hideval">
                </div>
                </form>                  
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="prod_reason" class="btn btn-primary">Submit</button>
      </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updatereasonModal" data-target="#update_reasonMoal">
<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>      
            </div>
            <div class="modal-body">
            <form role="form" id="updateformfield" action="" method="get"  enctype="multipart/form-data">

                <div class="form-group">
                    <h4 class="modal-title"><strong>Update Reason</strong></h4>
                    <br>
				    <input type="text" class="form-control" name="update_reason" id="update_reason" placeholder="Reason" required="">
                    
                    <input type="hidden" id="update_hidereson">
                </div>
                </form>                  
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="prod_update_reason" class="btn btn-primary">Submit</button>
      </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Todays Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        $('#status').change(function() {
            var selectedValue = $(this).val();
            var selectedStatus = $(this).attr("data-id");
            $('#hidereson').val(selectedStatus);
            $('#hideval').val(selectedValue);
            if (selectedValue == "3") {
                $('#reasonModal').modal('show');
            }
           else{
            $.post('{{ route('products.status') }}', {_token:'{{ csrf_token() }}', id:selectedStatus, status:selectedValue}, function(data){
                            if(data == 1){
                                showAlert('success', 'Status updated successfully');
                            }
                            else{
                                showAlert('danger', 'Something went wrong');
                            }
                        });
           }
            });
            $('#prod_reason').click(function() {
                // alert();
                var selectedReason = $('#reason').val();
            var selectedrsn = $('#hidereson').val();
            var selectedval = $('#hideval').val();
                $.post('{{ route('products.reason') }}', {_token:'{{ csrf_token() }}', id:selectedrsn, status:selectedval, reason:selectedReason }, function(data){
                            if(data == 1){
                                $('#reasonModal').modal('hide');
                                showAlert('success', 'Reason updated successfully');
                            }
                            else{
                                showAlert('danger', 'Something went wrong');
                            }
                        });
            });

            function update_product_reason(element){
            var value = element.getAttribute("value");
            console.log(value); 
            $('#update_hidereson').val(value);
            $('#updatereasonModal').modal('show');
            $.post('{{ route('products.reason') }}', {_token:'{{ csrf_token() }}', id:value }, function(data){
                const rejectReason = data[0].reject_reason;
                $('#update_reason').val(rejectReason);          
                
            });
        }

            $('#prod_update_reason').click(function() {
                var selectedReason_update = $('#update_reason').val();
            var selectedrsn_update = $('#update_hidereson').val();
            var selectedval_update = '3';
                $.post('{{ route('products.status') }}', {_token:'{{ csrf_token() }}', id:selectedrsn_update, status:selectedval_update, reason:selectedReason_update }, function(data){
                            if(data == 1){
                                $('#updatereasonModal').modal('hide');
                                showAlert('success', 'Reason updated successfully');
                            }
                            else{
                                showAlert('danger', 'Something went wrong');
                            }
                        });
            });

        
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_products(el){
            $('#sort_products').submit();
        }
        

    </script>
@endsection
