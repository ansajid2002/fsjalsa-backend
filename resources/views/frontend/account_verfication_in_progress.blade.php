@extends('frontend.layouts.app')
<style>
    body{
        background-color: #f3f3f3!important;
    }
    .f-container {
    height: 90vh;
    max-width: 60%;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
}
.f-card{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50% ,-50%);
    
}
h1 {
  font-size: 24px;
}

p {
  margin: 10px 0;
}

.contact-info {
  margin-top: 20px;
}
.model-2 a{
  padding:10px;
}
@media screen and (max-width: 767px){
  .f-container {
    max-width: 100%;
  }
  .f-card h1{
    font-size: 2rem!important;
  }
}
</style>
@section('content')

  <div class="f-container">
    <div class="f-card card p-5">
        <h1>Account is Still Under Process</h1>
            <p>Your account is currently being processed. Please wait for it to be fully activated.</p>
            <p>Contact our support team if you have any questions or need assistance.</p>
        <div class="contact-info">
            <p>Support Email: support@example.com</p>
            <p>Phone: +1-123-456-7890</p>
        </div>
    </div>
  </div>

@endsection