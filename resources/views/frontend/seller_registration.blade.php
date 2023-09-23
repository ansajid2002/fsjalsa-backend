@extends('frontend.layouts.app')

@section('content')
<style>
    .card0 {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
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

.next-button, .submit-button {
    width: 35%;
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
#progressbar li.active span {
        opacity: 0;
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
    position: relative;
    top: -33px;
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
    /* position: absolute; */
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
    .next-button, .submit-button{
        width:20%;
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
.color-theme{
    color: #337ab7;
}
.bold{
    font-weight: bold;
}
</style>

<div class="container-fluid px-1 px-4 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-11 col-lg-10 col-xl-9">
            <div class="card card0 border-0">
                <div class="row">
                    <div class="col-12">
                    <form class="form-default" role="form" action="{{ route('seller.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="card card00 m-2 border-0">
                        <p class="prev text-danger "><span class="fa fa-long-arrow-left"> Go Back</span></p id="back">
                            <div class="row">
                            <div class="col-lg-12 text-right px-5 py-3">
                                <p class="text-md">
                                    {{ translate('Already have an account?')}}<a href="{{ route('user.login') }}" class="strong-600">{{ translate('Log In')}}</a>
                                </p>
                            </div>
                            </div>
                            <div class="d-flex flex-md-row px-3 mt-4 flex-column-reverse">
                                <div class="col-md-4 col-offset-md-2">
                                    <div class="card1">
                                        <ul id="progressbar" class="text-center">
                                            <li class="active step step1" ><span class="title">1</span></li>
                                            <li class="step step2"><span class="title">2</span></li>
                                            <li class="step step3"><span class="title">3</span></li>
                                            <li class="step step4"><span class="title">4</span></li>
                                            <li class="step step4"><span class="title">5</span></li>
                                            <li class="step step4"><span class="title">6</span></li>
                                        </ul>

                                        <h6 class="mb-5" style="color:#337ab7;font-weight:bold;">Mobile verfication</h6>
                                        <h6 class="mb-5">Email</h6>
                                        <h6 style="margin-bottom: 40px;">Set password</h6>
                                        <h6 class="mb-5">Company details</h6>
                                        <h6 class="mb-5" style="margin-top: -0.6rem;">Shipping details</h6>
                                        <h6 class="mb-5" style="margin-top: -0.5rem;">Bank details</h6>
                                    </div>
                                    <div class="animation-img sms_otp" data-step="step_1" data-prev-step="step_0" id="step_1">
                                        <img class="lazyload" src="{{ asset('otp_receive.gif') }}">
                                    </div>
                                    <div class="animation-img email_verify d-none" data-step="step_2" data-prev-step="step_1" id="step_2">
                                        <img class="lazyload" src="{{ asset('email-verification.gif') }}">
                                    </div>
                                    <div class="animation-img password_verify d-none" data-step="step_3" data-prev-step="step_2" id="step_3">
                                        <img class="lazyload" src="{{ asset('lock.gif') }}">
                                    </div>
                                    <div class="animation-img company_details d-none" data-step="step_4" data-prev-step="step_3" id="step_4">
                                        <img class="lazyload" src="{{ asset('contact-card.gif') }}">
                                    </div>
                                    <div class="animation-img shipping_details d-none" data-step="step_5" data-prev-step="step_4" id="step_5">
                                        <img class="lazyload" src="{{ asset('shipping.gif') }}">
                                    </div>
                                    <div class="animation-img bank_details d-none" data-step="step_6" data-prev-step="step_5" id="step_6">
                                        <img class="lazyload" src="{{ asset('bank.gif') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="card2 first-screen show ml-2">
                                        <h2 class="color-theme">
                                            Mobile Verification
                                        </h2>
                                        <div class="row px-3 mt-3">
                                            <div class="col-lg-10 p-1">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="mobile" name="mobile" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="mobile">Enter Mobile</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a valid Mobile Number.
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <div class="send-button text-center mt-2 "  data-toggle="modal" data-target="#otpVerifyModal">Send OTP
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex justify-content-end">
                                            <div class="next-button text-center mt-3 ml-2" data-step="sms_otp" data-step-next="email_verify">Next<span class="fa fa-arrow-right ml-1"></span>
                                             </div>
                                        </div>
                                    </div>


                                    <div class="card2 ml-2">
                                        <h2 class="color-theme">
                                            Mailing Address
                                        </h2>
                                        <div class="row px-3 mt-3">
                                            <div class="col-lg-10 p-1">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="email" name="email" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="email">Enter Email</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a valid email address.
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-0">
                                                <div class="send-button text-center mt-2"  data-toggle="modal" data-target="#otpVerifyModal">Send OTP
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex justify-content-end">
                                            <div class="next-button text-center mt-3 ml-2" data-step="email_verify" data-step-next="password_verify">Next<span class="fa fa-arrow-right ml-1"></span>
                                             </div>
                                        </div>
                                    </div>

                                    <div class="card2 ml-2">
                                        <h2 class="color-theme">
                                                Create Password
                                        </h2>
                                        <div class="row px-3 mt-3">
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
                                            <div class="invalid-feedback">
                                                Please enter a Password or Both Password didn't matched.
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- <label>{{  translate('confirm_password') }}</label> -->
                                            <div class="input-group input-group--style-1">
                                                <input type="password" name="confirm_password" class="h-auto form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                            </div>
                                        </div>

                                        @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif
                                            <div class="next-button text-center mt-1 ml-2" data-step="password_verify" data-step-next="company_details">Next                                    </div>
                                        </div>
                                    </div>

                                    <div class="card2 ml-2">
                                        <h2 class="color-theme">
                                            Company Details
                                        </h2>
                                        <div class="row px-3 mt-3">
                                            {{--<p class="mb-0">Select your Country</p>
                                            <div class="form-group mt-3 mb-4">
                                                <div class="select mb-3">
                                                    <select name="account" class="form-control">
                                                        <option>India</option>
                                                        <option>USA</option>
                                                        <option>Germany</option>
                                                        <option>Mexico</option>
                                                    </select>
                                                </div>
                                            </div>--}}
                                            <div class="col-lg-6">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="gst" name="gstin" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="gst">GSTIN NO</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="cmp-pan" name="cmp_pan_number" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="cmp-pan">Company pan</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="cmp-name" name="cmp_name" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="cmp-name">Company Name</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="legal-name" name="legal_name" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="legal-name">Legal Name</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="address" class="form-control" name="address" required>
                                                    <label class="ml-3 form-control-placeholder" for="address">Address</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="pin-code" name="pin_code" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="pin-code">Pin Codde</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="city" name="city" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="city">City</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="state" name="state" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="state">State</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="country" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="country">Country</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="file" name="cmp_file" id="cmp_file" class="input-file">
                                                    <label for="cmp_file" class="btn btn-file-upload file-label">
                                                        <span class="fileName mt-1">Company</span>
                                                        <i class="icon fa fa-check"></i>
                                                    </label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please Upload attachment.
                                                </div>
                                            </div>    
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="file" name="cmp_gst" id="cmp_gst" class="input-file">
                                                    <label for="cmp_gst" class="btn btn-file-upload file-label">
                                                        <span class="fileName mt-1">Upload GST</span>
                                                        <i class="icon fa fa-check"></i>
                                                    </label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please Upload attachment.
                                                </div>
                                            </div>    
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input type="file" name="cmp_pan" id="cmp_pan" class="input-file">
                                                    <label for="cmp_pan" class="btn btn-file-upload file-label">
                                                        <span class="fileName mt-1">Upload PAN</span>
                                                        <i class="icon fa fa-check"></i>
                                                    </label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please Upload attachment.
                                                </div>
                                            </div>    
                                            <div class="next-button text-center mt-3 ml-2" data-step="company_details" data-step-next="shipping_details">Next
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card2 ml-2">
                                        <h2 class="color-theme">
                                            Shipping Details
                                        </h2>
                                        <div class="row px-3 mt-3">
                                            <div class="col-lg-12 checkbox text-left">
                                                <input class="magic-checkbox" type="checkbox" name="checkbox_example_1" id="checkboxExample_1a" required>
                                                <label for="checkboxExample_1a" class="text-sm">{{ translate('Same As Company Address')}}</label>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="ship_city" class="form-control" name="ship_city" required>
                                                    <label class="ml-3 form-control-placeholder" for="city">City</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="ship_pin_code" class="form-control" name="ship_pin_code" required>
                                                    <label class="ml-3 form-control-placeholder" for="pin-code">Pincode</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="address2" class="form-control" name="" required>
                                                    <label class="ml-3 form-control-placeholder" for="address2">Address 2</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="ship_state" class="form-control" name="ship_state" required >
                                                    <label class="ml-3 form-control-placeholder" for="state">State</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="nation" name="nation" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="nation">India</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex justify-content-end">
                                            <div class="next-button text-center mt-3 ml-2"  data-step="shipping_details" data-step-next="bank_details">Next<span class="fa fa-arrow-right ml-1"></span>
                                             </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card2 ml-2">
                                        <h2 class="color-theme">
                                            Bank Details
                                        </h2>
                                        <div class="row px-3 mt-3">
                                            <div class="col-lg-12 text-left">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="acc_name" class="form-control" name="account_holder_name" required>
                                                    <label class="ml-3 form-control-placeholder" for="acc_name">Account Holder Name</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="acc_number" class="form-control" name="bank_acc_no" required>
                                                    <label class="ml-3 form-control-placeholder" for="acc_number">Account Number</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="verify_accNum" class="form-control" required>
                                                    <label class="ml-3 form-control-placeholder" for="verify_accNum">Verify Account Number</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-1">
                                                    <input type="text" id="ifsc_code" class="form-control" name="ifsc_code" required>
                                                    <label class="ml-3 form-control-placeholder" for="ifsc_code">IFSC Code</label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please enter a value.
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-3">
                                                <div class="form-group mt-1 mb-4">
                                                    <div class="select mb-3">
                                                        <select name="bank_acc_type" class="form-control">
                                                            <option selected>Select Account Type</option>
                                                            <option>Current</option>
                                                            <option>Saving</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please Select Account Type.
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                        <input type="file" name="bank_chq" id="bank_chq" class="input-file">
                                                        <label for="bank_chq" class="btn btn-file-upload file-label">
                                                            <span class="fileName mt-1">Upload Cancel Cheque</span>
                                                            <i class="icon fa fa-check"></i>
                                                        </label>
                                                </div>
                                                <div class="invalid-feedback">
                                                Please Upload atttachment.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex justify-content-end">
                                            <button type="submit" class="submit-button text-center mt-3 ml-2" >Submit<span class="fa fa-arrow-right ml-1"></span>
                                             </button>
                                        </div>
                                    </div>

                                    {{--<div class="card2 ml-2">
                                        <div class="row px-3 mt-2 mb-4 text-center">
                                            <h2 class="col-12 text-danger"><strong>Success !</strong></h2>
                                            <div class="col-12 text-center"><img class="tick" src="https://i.imgur.com/WDI0da4.gif"></div>
                                            <h6 class="col-12 mt-2"><i>...Enjoy COOKIES...</i></h6>
                                        </div>
                                    </div>--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="otpVerifyModal" tabindex="-1" role="dialog" aria-labelledby="otpVerifyModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">OTP VERIFICATION</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Your confirmation code is Waiting for you in Your Inbox!..</p>
        <div class="mt-1 mb-1">
            <input type="text" id="otp" class="form-control" required>
        </div>
        <p>Didn't get any code ? <a href="#">Send a new one</a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block otp-cnfrm-btn" onclick="submitOTP()">Confirm</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        $('.logo-bar-area').hide();
        $('.footer-top').hide();
        $('.cod-icon').hide();
        function submitOTP() {
            showFrontendAlert('success','WOW!<br>OTP Verified.')
        }
        var step_no = 1;
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

        $(document).ready(function(){
            $('.email-form-group').hide();

            var current_fs, next_fs, previous_fs;

        // No BACK button on first screen
        if($(".show").hasClass("first-screen")) {
            $(".prev").css({ 'display' : 'none' });
        }

        // Next button
        $(".next-button").click(function() {
            var current_fs = $(this).parent().parent();
            var next_fs = $(this).parent().parent().next();
            var curr_step = $(this).attr('data-step');
            var next_step = $(this).attr('data-step-next');
            
            var inputFields = current_fs.find("input[required]");
            var isValid = true;

            inputFields.each(function() {
                if (!$(this).val()) {
                $(this).addClass("is-invalid");
                isValid = false;
                } else {
                $(this).removeClass("is-invalid");
                }
            });

            var password = current_fs.find("input[name='password']").val();
            var confirmPassword = current_fs.find("input[name='confirm_password']").val();
            if (password !== confirmPassword) {
                current_fs.find("input[name='confirm_password']").addClass("is-invalid");
                isValid = false;
            } else {
                current_fs.find("input[name='confirm_password']").removeClass("is-invalid");
            }
            if (isValid) {
                $(".prev").css({ 'display': 'block' });

                $(current_fs).removeClass("show");
                $(next_fs).addClass("show");
                $("."+curr_step).addClass('d-none');
                $("."+next_step).removeClass('d-none');
                current_fs.find(".invalid-feedback").hide();
                $("#progressbar li").eq($(".card2").index(next_fs)).addClass("active");

                current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                    });

                    next_fs.css({
                    'display': 'block'
                    });
                }
                });
                step_no++;
            }else{
                current_fs.find(".invalid-feedback").show();
                $("."+curr_step).removeClass("d-none");
                $("."+next_step).addClass("d-none");
            }
            });

        $(".next-email").click(function() {
            $(".sms_otp").addClass("d-none");
            $(".email_verify").removeClass("d-none");
        });
        $(".next-password").click(function() {
            $(".email_verify").addClass("d-none");
            $(".password_verify").removeClass("d-none");
        });
        $(".next-cmp").click(function() {
            $(".password_verify").addClass("d-none");
            $(".company_details").removeClass("d-none");
        });
        $(".next-shipping").click(function() {
            $(".company_details").addClass("d-none");
            $(".shipping").removeClass("d-none");
        });
        $(".next-bank").click(function() {
            $(".shipping").addClass("d-none");
            $(".bank_details").removeClass("d-none");
        });
    $()
// Previous button
    $(".prev").click(function(){
       
        current_fs = $(".show");
        previous_fs = $(".show").prev();
        var curr_step = step_no;
        var prev_step = step_no - 1;
        $(current_fs).removeClass("show");
        $(previous_fs).addClass("show");

        $(".prev").css({ 'display' : 'block' });
        $("#step_"+curr_step).addClass('d-none');
        $("#step_"+prev_step).removeClass('d-none');
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
        step_no--;
    });
        });

        function autoFillSeller(){
            var city = $("#city").val();
            var pin_code = $("#pin-code").val();
            var address = $("#address").val();
            var state = $("#state").val();
            var country = $("#country").val();
            $('#ship_city').val(city);
            $('#ship_pin_code').val(pin_code);
            $('#address2').val(address);
            $('#ship_state').val(state);
            $('#nation').val(country);
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
        var checkbox = document.getElementById('checkboxExample_1a');

        checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Call your function here when the checkbox is checked
                    autoFillSeller();
                }
            });
    </script>
@endsection
