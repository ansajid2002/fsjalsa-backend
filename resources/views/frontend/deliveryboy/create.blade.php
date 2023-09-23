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
                                    {{ translate('Create an account for service boy')}}
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
                                        @if(session()->has('verifiedDeliveryBoyPhone'))
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
                                                    <input type="tel" id="mobileno"  class="h-auto form-control{{ $errors->has('mobileno') ? ' is-invalid' : '' }}" value="@if(session()->has('DeliveryBoyLoginMobileNo')){{session()->get('DeliveryBoyLoginMobileNo')}}@endif" placeholder="{{  translate('Mobile Number') }}" name="mobileno" @if(session()->has('Deliveryreadonly')){{session()->get('Deliveryreadonly')}}@endif>
                                                    @if(!session()->has('DeliveryBoyhasLoginOtp'))
                                                    <span class="btn btn-success" title="Send OTP" name="send" id="otpSenderLogin"><span>SEND OTP</span></span>
                                                    @endif

                                                    @if(!session()->has('verifiedDeliveryBoyPhone'))
                                                     @if(session()->has('DeliveryBoyhasLoginOtp'))
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
                                            @if(!session()->has('verifiedDeliveryBoyPhone'))
                                             @if(session()->has('DeliveryBoyhasLoginOtp'))
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

                                    @if(session()->has('verifiedDeliveryBoyPhone'))
                                      <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="text" class="h-auto form-control{{ $errors->has('names') ? ' is-invalid' : '' }}" value="{{ old('names') }}" placeholder="{{  translate('Name') }}" name="names" required>
                                                    @if ($errors->has('names'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('names') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>






                                            <!-- <div class="form-group">
                                                <button class="btn btn-link p-0" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div> -->

                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="email" class="h-auto form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"required>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                        <div class="form-group">
                                            <!-- <label>{{  translate('password') }}</label> -->
                                            <div class="input-group input-group--style-1">
                                                <input type="hidden" class="h-auto form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="12345678" placeholder="{{  translate('Password') }}" name="password">
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <b>Enter Address: <br><br> </b>
                                        <div class="form-group">

                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('house') ? ' is-invalid' : '' }}" value="{{ old('house') }}" placeholder="{{  translate('Flat/House No') }}" name="house" required>
                                                @if ($errors->has('house'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('house') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('building') ? ' is-invalid' : '' }}" value="{{ old('building') }}" placeholder="{{  translate('Building') }}" name="building" required>
                                                @if ($errors->has('building'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('building') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" value="{{ old('street') }}" placeholder="{{  translate('Street') }}" name="street" required>
                                                @if ($errors->has('street'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('street') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                      <div class="form-group">
                                        <div class="input-group input-group--style-1">
                                          <input type="text" class="h-auto form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" value="{{ old('state') }}" placeholder="{{  translate('State') }}" name="state" required>
                                                  @if ($errors->has('state'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('state') }}</strong>
                                                    </span>
                                                  @endif
                                            </div>
                                        </div>
                                      </div>

                                      <div class="col-md-4">

                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ old('city') }}" placeholder="{{  translate('City') }}" name="city" required>
                                                @if ($errors->has('city'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('pincode') ? ' is-invalid' : '' }}" value="{{ old('pincode') }}" placeholder="{{  translate('Pincode') }}" name="pincode" required>
                                                @if ($errors->has('pincode'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label>Upload Photo <br><br></label>
                                            <div class="input-group input-group--style-1">

                                                <input type="file" class="h-auto form-control{{ $errors->has('yourphoto') ? ' is-invalid' : '' }}" value="{{ old('yourphoto') }}" placeholder="{{  translate('Photo') }}" name="yourphoto" required>
                                                @if ($errors->has('yourphoto'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('yourphoto') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label>Upload Aadhar Card Photo <br><br></label>
                                            <div class="input-group input-group--style-1">

                                                <input type="file" class="h-auto form-control{{ $errors->has('aadhar_photo') ? ' is-invalid' : '' }}" value="{{ old('aadhar_photo') }}" placeholder="{{  translate('Aadhar') }}" name="aadhar_photo" required>
                                                @if ($errors->has('aadhar_photo'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('aadhar_photo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                      </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('dln') ? ' is-invalid' : '' }}" value="{{ old('dln') }}" placeholder="{{  translate('Driving Licence Number') }}" name="dln" required>
                                                @if ($errors->has('dln'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('dln') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('pancardno') ? ' is-invalid' : '' }}" value="{{ old('pancardno') }}" placeholder="{{  translate('PAN No') }}" name="pancardno" required>
                                                @if ($errors->has('pancardno'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('pancardno') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('bankname') ? ' is-invalid' : '' }}" value="{{ old('bankname') }}" placeholder="{{  translate('Bank Name') }}" name="bankname" required>
                                                @if ($errors->has('bankname'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('bankname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('ifsc') ? ' is-invalid' : '' }}" value="{{ old('ifsc') }}" placeholder="{{  translate('IFSC Code') }}" name="ifsc" required>
                                                @if ($errors->has('ifsc'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('ifsc') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('bankaccno') ? ' is-invalid' : '' }}" value="{{ old('bankaccno') }}" placeholder="{{  translate('Bank Account No') }}" name="bankaccno" required>
                                                @if ($errors->has('bankaccno'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('bankaccno') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label>Working Hours Time:<br><br></label>
                                            <div class="input-group input-group--style-1">
                                                <input type="time" class="h-auto form-control{{ $errors->has('workfrom') ? ' is-invalid' : '' }}" value="{{ old('workfrom') }}" placeholder="{{  translate('Work from') }}" name="workfrom">
                                                <input type="time" class="h-auto form-control{{ $errors->has('workto') ? ' is-invalid' : '' }}" value="{{ old('workto') }}" placeholder="{{  translate('Work to') }}" name="workto">
                                            </div>
                                        </div>
                                      </div>

                                        <div class="col-md-4 offset-md-4">
                                        <div class="checkbox text-left">
                                            <input class="magic-checkbox" type="checkbox" name="checkbox_example_1" id="checkboxExample_1a" required>
                                            <label for="checkboxExample_1a" class="text-sm">{{ translate('By signing up you agree to our terms and conditions.')}}</label>
                                        </div>

                                        <div class="text-right mt-3">
                                            <button type="submit" class="btn btn-styled btn-base-1 w-100 btn-md">{{  translate('Create Account') }}</button>
                                        </div>

                                      </div>
                                  </div>
                                @endif

                                    </form>

                                </div>
                            </div>
                            <div class="text-center px-35 pb-3">
                                <p class="text-md">
                                    {{ translate('Already have an account?')}}<a href="/login/service-person" class="strong-600">{{ translate('Log In')}}</a>
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
        $.get(`/sendSmsForRegOtpDel?mobileNo=${userPhone}`,{},(res)=>{

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
        $.get(`/verifyDeliveryBoyOtp?otpNo=${userOtp}&moboNo=${userPhone}`,{},(res)=>{
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
