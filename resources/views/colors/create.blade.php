@extends('layouts.app')

@section('content')

<div class="col-lg-6">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{ translate('Create new color')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('colors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{ translate('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="color" id="colorpicker"   pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55"> 
 
                        <input type="text" name="code" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55" id="hexcolor"></input>
                        <p><span id="colorText"></span></p>
                        <input type="hidden" id="color_name" name="color_name"></input>
                    </div>
                </div>
<!--                 <div class="form-group">
                    <label class="col-sm-2 control-label" for="code">{{ translate('code')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{ translate('code')}}" id="code" name="code" class="form-control" required>
                    </div>
                </div> -->
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{ translate('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
$('#colorpicker').on('input', function() {
	$('#hexcolor').val(this.value);
});
$('#hexcolor').on('input', function() {
  $('#colorpicker').val(this.value);
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

var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;



canvas.addEventListener('mousemove', function(event) {
  let bound = canvas.getBoundingClientRect();

  let x = event.clientX - bound.left - canvas.clientLeft;
  let y = event.clientY - bound.top - canvas.clientTop;
  
  let pickerColor = ctx.getImageData(x, y, 1,1).data;
  
  let hoveredColor = '#' + pickerColor[0].toString(16).pad() + pickerColor[1].toString(16).pad() + pickerColor[2].toString(16).pad();
  
  let colorName = colorChecker( hoveredColor );

  document.querySelector('#colorText').innerHTML = "You are hovering over " + (colorName.isExactMatch == false ? "a color very close to ":"") + "<span style='color:" + colorName.hex + "'>" + colorName.name + " (" + colorName.hex + ")</span>";
}, false);
</script>
@endsection
