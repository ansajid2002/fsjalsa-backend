@extends('layouts.app')

@section('content')

    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{translate('Color Update')}}</h3>
            </div>

            <form class="form-horizontal" action="{{ route('colors.update', $color->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
            	@csrf
                <div class="panel-body">
                    <input type="hidden" name="id" value="{{ $color->id }}" id="id">
                    <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{ translate('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="color" id="colorpicker"   pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{$color->code}}" required> 
 
                        <input type="text" name="code" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="{{$color->code}}" id="hexcolor"></input>
                    </div>
                    <p><span id="colorText" style="color:{{$color->code}}">{{$color->name}}</span></p>
                    <input type="hidden" id="color_name" name="color_name" value="{{$color->name}}"></input>

                </div>

                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
                </div>
            </form>

        </div>
    </div>


@endsection
@section('script')

<script >
$(document).on('input', '#colorpicker', function() {
    var hexCode = $(this).val();
    $('#hexcolor').val(hexCode);
});

String.prototype.pad = function(size) {
        var s = String(this);
        while (s.length < (size || 2)) {s = "0" + s;}
        return s;
    }

document.querySelector('#colorpicker').addEventListener('change', function() {
  let colorName = colorChecker( document.querySelector('#colorpicker').value );

 var span = document.querySelector('#colorText').innerHTML = "You have choosen " + (colorName.isExactMatch == false ? "a color very close to -- ":"") + "<span  id='colorName'  style='color:" + colorName.hex + "'>" + colorName.name + " </span>";//(" + colorName.hex + ")
 document.querySelector('#color_name').value = colorName.name;
}, false);


</script>
@endsection