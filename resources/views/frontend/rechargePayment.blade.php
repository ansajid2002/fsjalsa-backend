<style>
.button_can {
  background-color: orange;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<center><h1>Please do not refresh this page!</h1></center>
<center><a href="/"><button class="button_can">Cancel Recharge</button></a></center>
<button style="display:none;" id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
    "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "{{$response['name']}}",
    "description": "{{$response['desc']}}",
    "image": "http://sabgharpe.com/images/app_logo/10-08-2020/Logo.png",
    "order_id": "{{$response['order_id']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
      document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
      document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
      document.getElementById('razorpay_signature').value = response.razorpay_signature;
      document.getElementById('submitted').click();
    },
    "prefill": {
        "name": "{{$response['name']}}",
        "email": "{{$response['email']}}",
        "contact": "{{$response['mobile']}}"
    },
    "notes": {
        "address": "Maharashtra"
    },
    "theme": {
        "color": "#40c9ac"
    }
};
var rzp1 = new Razorpay(options);
window.onload = function(){
  document.getElementById('rzp-button1').click();
};
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
<form method="post" action="/completePaymentForRec" hidden>
  @csrf
<input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id">
<input type="hidden" id="razorpay_order_id" name="razorpay_order_id">
<input type="hidden" id="razorpay_signature" name="razorpay_signature">
<button type="submit" id="submitted">submit</button>
</form>
