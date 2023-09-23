@extends('frontend.layouts.app')

@section('content')
<style>
    .card0 {
    background-color: #F5F5F5;
    border-radius: 8px;
    z-index: 0;
}

/*Inner Card*/
.card00 {
    z-index: 0;
}

/*Left side card with progressbar*/
.card1 {
    margin-left: 110px;
    z-index: 0;
    border-right: 1px solid #F5F5F5;
}

/*right side cards*/
.card2 {
    display: none;
}

.card2.show {
    display: block;
}
.form-group {
    position: relative;
    margin-bottom: 1.5rem;
    width: 100%;
}

.form-control-placeholder {
    position: absolute;
    top: 0px;
    padding: 12px 2px 0 2px;
    transition: all 300ms;
    opacity: 0.5;
}

.form-control:focus + .form-control-placeholder,
.form-control:valid + .form-control-placeholder {
    font-size: 95%;
    top: 10px;
    transform: translate3d(0, -100%, 0);
    opacity: 1;
    background-color: #fff;
}

.next-button {
    width: 20%!important;
    height: 40px;
    background-color: #337ab7;
    color: #fff;
    border-radius: 6px;
    padding: 10px;
    cursor: pointer;
    border-radius: 35px;
}
.send-button {
    height: 36px;
    background-color: #337ab7;
    color: #fff;
    border-radius: 3px 15px 15px 3px;
    padding: 10px;
    cursor: pointer;
}

.next-button:hover, .send-button:hover {
    background-color: #337ab7;
    color: #fff;
}
.send-button:hover {
    background-color: #337ab7;
    color: #fff;
}

.get-bonus {
    margin-left: 154px;
}

/*Cookie pic*/
.pic {
    width: 230px;
    height: 110px;
}

/*Icon progressbar*/
#progressbar {
    position: absolute;
    left: 35px;
    overflow: hidden;
    color: #337ab7;
} 

#progressbar li {
    list-style-type: none;
    font-size: 8px;
    font-weight: 400;
    /* margin-bottom: 36px; */
}

/* #progressbar li:nth-child(3) {
    margin-bottom: 40px;
} */

#progressbar .step:before {
    content: "";
    color: #fff;
}
#progressbar .title {
    color: #fff;
    font-size: 24px;
    font-weight: 600;
}

#progressbar li:before {
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: block;
    font-size: 20px;
    background: #337ab7;
    border-radius: 50%;
    margin: auto;
}

#progressbar li:last-child:before {
    width: 30px;
    height: 30px;
}

/*ProgressBar connectors*/
/* #progressbar li:after {
    content: '';
    width: 3px;
    height: 66px;
    background: #BDBDBD;
    position: absolute;
    left: 54px;
    top: 15px;
    z-index: -1;
} */

#progressbar li:last-child:after {
    top: 147px;
    height: 132px;
}

#progressbar li:nth-child(3):after {
    top: 81px;
}

#progressbar li:nth-child(2):after {
    top: 0px;
}

#progressbar li:first-child:after {
    position: absolute;
    top: -81px;
}

/*Color of the connector before*/
#progressbar li.active:after {
    background: #337ab7;
}

/*Color of the step before*/
#progressbar li.active:before {
    background: #28a745;
    font-family: FontAwesome;
    content: "\f00c";
}

.tick {
    width: 100px;
    height: 100px;
}

.prev {
    display: block;
    position: absolute;
    left: 40px;
    top: 20px;
    cursor: pointer;
}

.prev:hover {
    color: #D50000 !important;
}
@media screen and (min-width: 576px){
    .modal-dialog {
        max-width: 500px;
        margin: 25.75rem auto;
    }
}
@media screen and (max-width: 912px) {
    .card00 {
        padding-top: 30px;
    }

    .card1 {
        border: none;
        margin-left: 50px;
    }

    .card2 {
        border-bottom: 1px solid #F5F5F5;
        margin-bottom: 25px;
    }

    .social {
        height: 30px;
        width: 30px;
        font-size: 15px;
        padding-top: 8px;
        margin-top: 7px;
    }

    .get-bonus {
        margin-top: 40px !important;
        margin-left: 75px;
    }

    #progressbar {
        left: -25px;
    }
}
#otpVerifyModal .modal-content{
    width: 400px;
}
.otp-cnfrm-btn{
    border-radius: 30px;
    width: 100%;
}
.animation-img img{
    height:250px;
}
.btn-file-upload {
  color: #555;
  padding: 0;
  line-height: 40px;
  margin: auto;
  display: block;
  border: 2px solid #555;
}
.btn-file-upload:hover, .btn-file-upload:focus {
  color: #888888;
  border-color: #888888;
}

/* input file style */
.input-file {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  z-index: -1;
}
.input-file + .file-label {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  padding: 0 10px;
  cursor: pointer;
}
.input-file + .file-label .icon:before {
  content: "";
}
.input-file + .file-label.has-file .icon:before {
  content: "";
  color: #5AAC7B;
}
</style>
    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h1 class="heading heading-4 strong-500">
                                    {{ translate('Create an account.')}}
                                </h1>
                            </div>
                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="h-auto form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Name') }}" name="name">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                            <div class="form-group phone-form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="tel" id="phone-code" class="border-right-0 h-auto w-100 form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="{{  translate('Mobile Number') }}" name="phone">
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                </div>
                                            </div>

                                            <input type="hidden" name="country_code" value="">

                                            <div class="form-group email-form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="email" class="h-auto form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-link p-0" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="email" class="h-auto form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <!-- <label>{{  translate('password') }}</label> -->
                                            <div class="input-group input-group--style-1">
                                                <input type="password" class="h-auto form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- <label>{{  translate('confirm_password') }}</label> -->
                                            <div class="input-group input-group--style-1">
                                                <input type="password" class="h-auto form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                            </div>
                                        </div>

                                        @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif

                                        <div class="checkbox text-left">
                                            <input class="magic-checkbox" type="checkbox" name="checkbox_example_1" id="checkboxExample_1a" required>
                                            <label for="checkboxExample_1a" class="text-sm">{{ translate('By signing up you agree to our terms and conditions.')}}</label>
                                        </div>

                                        <div class="text-right mt-3">
                                            <button type="submit" class="btn btn-styled btn-base-1 w-100 btn-md">{{  translate('Create Account') }}</button>
                                        </div>
                                    </form>
                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                        <div class="or or--1 mt-3 text-center">
                                            <span>or</span>
                                        </div>
                                        <div>
                                        @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                                <i class="icon fa fa-facebook"></i> {{ translate('Login with Facebook')}}
                                            </a>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                                <i class="icon fa fa-google"></i> {{ translate('Login with Google')}}
                                            </a>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4">
                                                <i class="icon fa fa-twitter"></i> {{ translate('Login with Twitter')}}
                                            </a>
                                        @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center px-35 pb-3">
                                <p class="text-md">
                                    {{ translate('Already have an account?')}}<a href="{{ route('user.login') }}" class="strong-600">{{ translate('Log In')}}</a>
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
            $('.input-file').each(function() {
            var $input = $(this),
                $label = $input.next('.file-label'),
                labelVal = $label.html();
            
        $input.on('change', function(element) {
            var fileName = '';
            if (element.target.value) fileName = element.target.value.split('\\').pop();
            fileName ? $label.addClass('has-file').find('.fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
        });
        });
        });

        var isPhoneShown = true;

       /*  var input = document.querySelector("#phone-code");
        var iti = intlTelInput(input, {
            separateDialCode: true,
            preferredCountries: @php echo json_encode(\App\Country::where('status', 1)->pluck('code')->toArray()) @endphp
        }); 

        var countryCode = iti.getSelectedCountryData();


        input.addEventListener("countrychange", function() {
            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);
        });*/

// Previous button
    $(".prev").click(function(){
        
        current_fs = $(".show");
        previous_fs = $(".show").prev();
        
        $(current_fs).removeClass("show");
        $(previous_fs).addClass("show");

        $(".prev").css({ 'display' : 'block' });

        if($(".show").hasClass("first-screen")) {
            $(".prev").css({ 'display' : 'none' });
        }

        $("#progressbar li").eq($(".card2").index(current_fs)).removeClass("active");

        current_fs.animate({}, {
            step: function() {

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });

                previous_fs.css({
                    'display': 'block'
                });
            }
        });
    });
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
