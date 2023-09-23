@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="@if(session()->has('verifiedDeliveryBoyPhone'))col-md-12 @else col-md-12 @endif mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h1 class="heading heading-4 strong-500">
                                    {{ translate('Service Boy Login')}}
                                </h1>
                            </div>
                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form id="reg-form" class="form-default" action="{{ URL::route('register-deliveryboy') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                    <div class="row">
                                      <div class="col-md-4 offset-md-4">
                                        @if (count($errors) > 0)
                                          <div class = "alert alert-danger">
                                             <ul>
                                                @foreach ($errors->all() as $error)
                                                   <li>{{ $error }}</li>
                                                @endforeach
                                             </ul>
                                          </div>
                                       @endif
                                        @if(session('success'))
                                         <div class="alert alert-success">
                                             {!! session('success') !!}
                                         </div>
                                         @endif
                                        @if(session()->has('verifiedServiceBoyPhone'))
                                         <div class="alert alert-success">
                                             Mobile number has been verified.
                                         </div>
                                         @endif

                                       @if(session('error'))
                                               <div class="alert alert-danger">
                                                   {!! session('error') !!}
                                              </div>
                                       @endif
                                       <div id="alertArea"></div>
                                          <div class="form-group">
                                            <div class="form-group email-form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="tel" id="mobileno"  class="h-auto form-control{{ $errors->has('mobileno') ? ' is-invalid' : '' }}" value="@if(session()->has('ServiceBoyLoginMobileNo')){{session()->get('ServiceBoyLoginMobileNo')}}@endif" placeholder="{{  translate('Mobile Number') }}" name="mobileno" @if(session()->has('Servicereadonly')){{session()->get('Servicereadonly')}}@endif>
                                                    @if(!session()->has('ServiceBoyhasLoginOtp'))
                                                    <span class="btn btn-success" title="Send OTP" name="send" id="otpSenderLogin"><span>SEND OTP</span></span>
                                                    @endif

                                                    @if(!session()->has('verifiedServiceBoyPhone'))
                                                     @if(session()->has('ServiceBoyhasLoginOtp'))
                                                    <span class="btn btn-success" title="Send OTP" name="send" id="otpSenderLogin"><span>RESEND OTP</span></span>
                                                    @endif
                                                  @endif

                                                    @if ($errors->has('mobileno'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mobileno') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                             </div>
                                           </div>
                                            @if(!session()->has('verifiedServiceBoyPhone'))
                                             @if(session()->has('ServiceBoyhasLoginOtp'))
                                             <div class="form-group">
                                               <div class="form-group email-form-group">
                                                  <div class="input-group input-group--style-1">
                                                      <input value="" type="number" name="user_otp" class="h-auto form-control" placeholder="Enter OTP" id="user_otp" title="OTP">
                                                      <span class="btn btn-success" title="Verify OTP" name="send" id="verifySenderLogin"><span>Verify & Login</span></span>
                                                  </div>
                                                </div>
                                              </div>
                                              @endif
                                            @endif
                                    </div>
                                  </div>
                                </form>

                                </div>
                            </div>
                            <div class="text-center px-35 pb-3">
                                <p class="text-md">
                                    Does not have an account? <a href="/create/service-person" class="strong-600">{{ translate('Register')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
<script>
  $(document).ready(function(){
    $('#otpSenderLogin').on('click',function(e){
      e.preventDefault();
      const userPhone = $('#mobileno').val()
      var regex = /^(1\s?)?(\(\d{3}\)|\d{3})[\s\-]?\d{3}[\s\-]?\d{4}$/;
      if(!regex.test(userPhone)){
        $('#alertArea').html('');
        $('#alertArea').append(`<div class="alert alert-danger">
                                <b>Please Enter Valid Mobile Number.</b>
                               </div>`)
      }else{
        $.get(`/sendSmsForLoginOtpDel?mobileNo=${userPhone}`,{},(res)=>{

          if(res == 1){
            $('#alertArea').html('');
            $('#alertArea').append(`<div class="alert alert-success">
                                    <b>Great! otp has been sent to your registered mobile number.<br>otp is valid for 24 hours</b>
                                   </div>`)
            setTimeout(()=>{
              location.reload();
            },3000)
          }else if(res == 0){
            $('#alertArea').html('');
            $('#alertArea').append(`<div class="alert alert-danger">
                                    <b>Mobile Number Already Registered..Please Try Another</b>
                                   </div>`)
          }else if(res == 2){
            $('#alertArea').html('');
            $('#alertArea').append(`<div class="alert alert-danger">
                                    <b>Error Occured Try Again</b>
                                   </div>`)
          }
        })
      }
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('#verifySenderLogin').on('click',function(e){
      e.preventDefault();
      const userOtp = $('#user_otp').val()
      const userPhone = $('#mobileno').val()

      if(userOtp != "" && userPhone != ""){
        $('#alertArea').html('');
        $.get(`/verifyDeliveryBoyOtpLogin?otpNo=${userOtp}&moboNo=${userPhone}`,{},(res)=>{
          if(res == 1){
            $('#alertArea').append(`<div class="alert alert-success">
                                    <b>Great! Mobile No has been verified.</b>
                                   </div>`)
            setTimeout(()=>{
            location.reload();
            },3000)
          }else{
            $('#alertArea').html('');
            $('#alertArea').append(`<div class="alert alert-warning">
                                    <b>Warning! Your OTP is invalid</b>
                                   </div>`)

          }
        })
      }else{
        $('#alertArea').html('');
        $('#alertArea').append(`<div class="alert alert-danger">
                                <b>Please Enter OTP Number.</b>
                               </div>`)
      }
    });
  });
</script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">

        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            // alert('helloman');
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });

        var isPhoneShown = true;

        var input = document.querySelector("#phone-code");
        var iti = intlTelInput(input, {
            separateDialCode: true,
            preferredCountries: @php echo json_encode(\App\Country::where('status', 1)->pluck('code')->toArray()) @endphp
        });

        var countryCode = iti.getSelectedCountryData();


        input.addEventListener("countrychange", function() {
            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);
        });

        $(document).ready(function(){
            $('.email-form-group').hide();
        });

        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').hide();
                $('.email-form-group').show();
                isPhoneShown = false;
                $(el).html('Use Phone Instead');
            }
            else{
                $('.phone-form-group').show();
                $('.email-form-group').hide();
                isPhoneShown = true;
                $(el).html('Use Email Instead');
            }
        }
    </script>
@endsection
