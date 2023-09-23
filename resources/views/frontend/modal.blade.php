<style>
.minorJ::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.minorJ {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>
<div class="modal fade" id="errorModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center" style="background:#e85e6c">
				<div class="icon-box">
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
      <div class="modal-body text-center">
				<h4>Ooops!</h4>
				<p id="errorMsg" style="text-transform:uppercase"></p>
				<button class="btn btn-success" data-dismiss="modal" style="border-radius: 999px;border:none;justify-content:center;background-color:#eeb711;"><b>Try Again</b></button>
			</div>
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg model_for_recharge_plan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg gmu">
   <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><b>by sabgharpe.com</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mainContent">
        <div id="plannerDesk">
          <b>
          <div class="plan-and-operator">

          </div>
          </b>
        <div class="row">
          <div class="col-md-12">
          <div style="">
          <div class="minorJ" style="padding-top:10px;padding-bottom:10px;overflow-x:scroll">
            <span style="list-style-type:none;display:flex;align-items:center;padding:10px;" id="listOfOffer">

            </span>
           </div>
         </div>
        </div>
        </div>
        <div class="row">
         <div class="col-md-12">
           <div style="height:auto;background:#f1f1f1;color:white;border-radius:6px;">
           <div style="padding-top:10px;padding-bottom:10px;">
             <div class="table-responsive" id="listOfOfferData">

             </div>
          </div>
          </div>
         </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
   </div>
 </div>
</div>

<script>
$(document).ready(function(){
  $('.view_plan').on('click',function(){
    const elementId = $(this).attr('id');
    console.log(elementId);
    if(elementId == 'mobile_plan'){
     const circle = $('#circleOfPrepaid').val();
     const operator = $('#operatorOfPrepaid').val();
    if(!operator){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select operator</center></h6></center>`)
        $('#errorModalCenter').modal('show');
     }else if(!circle){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select circle</center></h6>`)
        $('#errorModalCenter').modal('show');
     }else{
        $('#errorMsg').html('');
        // $.get(`/getplan?circle=${circle}&operator=${operator}&type=${elementId}`,{},(res)=>{
        fetch(`/getplan?circle=${circle}&operator=${operator}&type=${elementId}`)
        .then((res)=> res.json())
        .then((responseData) => {
           $('.plan-and-operator').html('');
           $('.plan-and-operator').append(`Browse Plans of ${operator} - ${circle}`);

          var objArray = responseData;
          // console.log(objArray);
          var counterActive = 0;
          var counterForTab = 0;

           for (var records in objArray.records) {

             if(records == 0){
               $('#listOfOfferData').html('');
               $('#listOfOffer').html('');
               $('#listOfOfferData').append(`<center style="color:black"><h1>Plan Not Found</h1></center>`);
               $('#listOfOffer').append(`<center style="color:black;visibility:hidden"><h3>Plan Not Found</h3></center>`);

             }else{

          if(counterActive < 1){
             $('#listOfOfferData').html('');
             $('#listOfOfferData').append(`<table class="table table-striped myTable" id="upperTabFab${counterActive}" style="color:black">
             <thead class="thead-dark">
               <tr>
                   <th scope="col">Circle</th>
                   <th scope="col">Plan Type</th>
                   <th scope="col">Validity</th>
                   <th scope="col">Description</th>
                   <th scope="col">Plan</th>
               </tr>
             </thead>
             <tbody id="upperLift${counterActive}" class="tabFiled">

             </tbody>
             </table>
             `);
             $('#listOfOffer').html('');
             $('#listOfOffer').append(`<span class="innerPlan active" style="text-transform:uppercase;cursor:pointer" onclick="openDynamo('upperTabFab${counterActive}')">
                                       <b>${records}&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                       </span>`);
              for (var key in objArray.records[records]) {
                $(`#upperLift${counterActive}`).append(`<tr class="animated"><td>${circle}</td><td>${records}</td><td>${objArray.records[records][key].validity}</td><td>${objArray.records[records][key].desc}</td><td><button type="button" class="btn btn-primary plannerBestButton plannerBestButton" key="${records}" id="${objArray.records[records][key].rs}" data-dismiss="modal">Rs. ${objArray.records[records][key].rs}</button></td></tr>`);
              }
              counterActive++;
           }
           else{

             $('#listOfOfferData').append(`<table class="table table-striped myTable" id="upperTabFab${counterActive}" style="color:black;display:none;">
             <thead class="thead-dark">
               <tr>
                   <th scope="col">Circle</th>
                   <th scope="col">Plan Type</th>
                   <th scope="col">Validity</th>
                   <th scope="col">Description</th>
                   <th scope="col">Plan</th>
               </tr>
             </thead>
             <tbody id="upperLift${counterActive}" class="tabFiled">

             </tbody>
             </table>
             `);

             $('#listOfOffer').append(`<span class="innerPlan" style="text-transform:uppercase;cursor:pointer;" onclick="openDynamo('upperTabFab${counterActive}')">
                                                      <b>${records}&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                                      </span>`);

            for (var key in objArray.records[records]) {
                $(`#upperLift${counterActive}`).append(`
                 <tr class="animated"><td>${circle}</td><td>${records}</td><td>${objArray.records[records][key].validity}</td><td>${objArray.records[records][key].desc}</td><td><button type="button" id="${objArray.records[records][key].rs}" class="btn btn-primary plannerBestButton plannerBestButton" key="${records}" data-dismiss="modal">Rs. ${objArray.records[records][key].rs}</button></td></tr>`);
              }
              counterActive++;
           }
         }

        }


            // $.noConflict();
            $('.model_for_recharge_plan').modal('show');
        })

     }
   }else if(elementId == 'mobile_offer'){
     const mobileNoforprepaid = $('#mobileNoforprepaid').val();
     const operatorOfPrepaid = $('#operatorOfPrepaid').val();
     const regex = /^(1\s?)?(\(\d{3}\)|\d{3})[\s\-]?\d{3}[\s\-]?\d{4}$/;

     if(mobileNoforprepaid == ""){
       $('#errorMsg').html('');
       $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please enter mobile number</center></h6></center>`)
       $('#errorModalCenter').modal('show');
     }else if(!regex.test(mobileNoforprepaid)){
       $('#errorMsg').html('');
       $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please enter correct  mobile number</center></h6></center>`)
       $('#errorModalCenter').modal('show');
     }else if(operatorOfPrepaid == ""){
       $('#errorMsg').html('');
       $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select operator</center></h6></center>`)
       $('#errorModalCenter').modal('show');
     }else{
       $('#errorMsg').html('');
       // $.get(`/getplan?tel=${mobileNoforprepaid}&operator=${operatorOfPrepaid}&type=${elementId}`,{},(res)=>{
       fetch(`/getplan?tel=${mobileNoforprepaid}&operator=${operatorOfPrepaid}&type=${elementId}`)
       .then((res)=> res.json())
       .then((responseData)=>{

         $('.plan-and-operator').html('');
         $('#listOfOfferData').html('');
         $('.plan-and-operator').append(`Browse offer of ${operatorOfPrepaid} - ${mobileNoforprepaid}`);
         $('#listOfOfferData').append(`<table class="table table-striped" id="upperTabFab" style="color:black;">
         <thead class="thead-dark">
           <tr>
               <th scope="col">Mobile No</th>
               <th scope="col">Opertaor</th>
               <th scope="col">Description</th>
               <th scope="col">Plan</th>
           </tr>
         </thead>
         <tbody id="upperLift" class="tabFiled">

         </tbody>
         </table>
         `);

         $('#listOfOffer').append(`<li class="innerPlan" style="text-transform:uppercase;cursor:pointer">
                                                  <b>Offer</b>
                                                  </li>`);
         const dataResponseOffer = responseData;
           for (var recorder in dataResponseOffer.records) {

                     if(dataResponseOffer.records[recorder].rs == undefined){
                     $(`#upperLift`).append(`
                      <tr><td>${mobileNoforprepaid}</td><td>${operatorOfPrepaid}</td><td>${dataResponseOffer.records[recorder].desc}</td><td>-</td></tr>`);
                    }else{
                      $(`#upperLift`).append(`
                       <tr class="animated"><td>${mobileNoforprepaid}</td><td>${operatorOfPrepaid}</td><td>${dataResponseOffer.records[recorder].desc}</td><td><button type="button" id="${dataResponseOffer.records[recorder].rs}" class="btn btn-primary plannerBestButton plannerBestButton" key="mobile prepaid offer" data-dismiss="modal">Rs. ${dataResponseOffer.records[recorder].rs}</button></td></tr>`);
                    }
             }

             // jQuery.noConflict();
             $('.model_for_recharge_plan').modal('show');
       })
     }
   }else if(elementId == "dth_plan"){
      const operatorOfDth = $('#operatorOfDth').val();
      const elementId = $(this).attr('id');
      if(operatorOfDth == ""){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select dth operator</center></h6></center>`)
        $('#errorModalCenter').modal('show');
      }else{
        $('#errorMsg').html('');
        $('.plan-and-operator').html('');
        $.get(`/getplan?operator=${operatorOfDth}&type=${elementId}`,{},(res)=>{
          const dataResponseDthPlan = JSON.parse(res);
          $('.plan-and-operator').append(`Browse Plans of ${operatorOfDth}`);
          var counterDthActive = 0;
          var counterDthForTab = 0;

          for (var recorderDth in dataResponseDthPlan.records) {

            if(counterDthActive < 1){

               $('#listOfOfferData').html('');
               $('#listOfOfferData').append(`<table class="table table-striped" id="upperDthTabFab${counterDthActive}" style="color:black">
               <thead class="thead-dark">
                 <tr>
                     <th scope="col">Plan Name</th>
                     <th scope="col">Type</th>
                     <th scope="col">Description</th>
                     <th scope="col">Validity</th>
                     <th scope="col">Plan</th>
                 </tr>
               </thead>
               <tbody id="upperDthLift${counterDthActive}" class="tabDthFiled">

               </tbody>
               </table>
               `);

               $('#listOfOffer').html('');
               $('#listOfOffer').append(`<li class="innerPlan active" style="text-transform:uppercase;cursor:pointer" onclick="openDthDynamo('upperDthTabFab${counterDthActive}')">
                                         <b>${recorderDth}&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                         </li>`);
                for (var key in dataResponseDthPlan.records[recorderDth]) {
                    for (var planVerit in dataResponseDthPlan.records[recorderDth][key].rs) {
                        const f = JSON.stringify(planVerit);
                        $(`#upperDthLift${counterDthActive}`).append(`<tr class="animated"><td>${dataResponseDthPlan.records[recorderDth][key].plan_name}</td><td>${recorderDth}</td><td>${dataResponseDthPlan.records[recorderDth][key].desc}</td><td>${f.slice(1,-1)}</td><td><button type="button" class="btn btn-primary plannerBestButton plannerBestButtonDth" key="${recorderDth}" id="${dataResponseDthPlan.records[recorderDth][key].rs[planVerit]}" data-dismiss="modal">Rs. ${dataResponseDthPlan.records[recorderDth][key].rs[planVerit]}</button></td></tr>`);
                      }

                }
              counterDthActive++;
            }else{
              $('#listOfOfferData').append(`<table class="table table-striped" id="upperDthTabFab${counterDthActive}" style="color:black;display:none;">
              <thead class="thead-dark">
                <tr>
                    <th scope="col">Plan Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Description</th>
                    <th scope="col">Validity</th>
                    <th scope="col">Plan</th>
                </tr>
              </thead>
              <tbody id="upperDthLift${counterDthActive}" class="tabDthFiled">

              </tbody>
              </table>
              `);

              $('#listOfOffer').append(`<li class="innerPlan active" style="text-transform:uppercase;cursor:pointer" onclick="openDthDynamo('upperDthTabFab${counterDthActive}')">
                                        <b>${recorderDth}&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        </li>`);
               for (var key in dataResponseDthPlan.records[recorderDth]) {
                   for (var planVerit in dataResponseDthPlan.records[recorderDth][key].rs) {
                         const f = JSON.stringify(planVerit);
                       $(`#upperDthLift${counterDthActive}`).append(`<tr class="animated"><td>${dataResponseDthPlan.records[recorderDth][key].plan_name}</td><td>${recorderDth}</td><td>${dataResponseDthPlan.records[recorderDth][key].desc}</td><td>${f.slice(1,-1)}</td><td><button type="button" class="btn btn-primary plannerBestButton plannerBestButtonDth" key="${recorderDth}" id="${dataResponseDthPlan.records[recorderDth][key].rs[planVerit]}" data-dismiss="modal">Rs. ${dataResponseDthPlan.records[recorderDth][key].rs[planVerit]}</button></td></tr>`);
                     }

               }
             counterDthActive++;
            }
          }
          // jQuery.noConflict();
          $('.model_for_recharge_plan').modal('show');
        })
      }
   }else if(elementId == "dataCard"){
     $('.plan-and-operator').html('');
     const elementId = $(this).attr('id');
     const circle = $('#dataCardCircle').val();
     const operator = $('#dataCardOperator').val();
    if(!operator){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select datacard operator</center></h6></center>`)
        $('#errorModalCenter').modal('show');
     }else if(!circle){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select datacard circle</center></h6>`)
        $('#errorModalCenter').modal('show');
     }else{
        $('#errorMsg').html('');
        $.get(`/getplan?circle=${circle}&operator=${operator}&type=${elementId}`,{},(res)=>{

          $('.plan-and-operator').append(`Browse Plans of ${operator} - ${circle}`);
           const dataCardResponse = JSON.parse(res);
             for (var datacardRecord in dataCardResponse.records) {
                  if(datacardRecord == "3G/4G"){
                    $('#listOfOfferData').html('');
                    $('#listOfOfferData').append(`<table class="table table-striped" id="upperTabFab" style="color:black">
                    <thead class="thead-dark">
                      <tr>
                          <th scope="col">Circle</th>
                          <th scope="col">Plan Type</th>
                          <th scope="col">Validity</th>
                          <th scope="col">Description</th>
                          <th scope="col">Plan</th>
                      </tr>
                    </thead>
                    <tbody id="upperLift" class="tabFiled">

                    </tbody>
                    </table>
                    `);
                    $('#listOfOffer').html('');
                    $('#listOfOffer').append(`<li class="innerPlan active" style="text-transform:uppercase;cursor:pointer">
                                              <b>${datacardRecord}</b>
                                              </li>`);
                    for (var key in dataCardResponse.records[datacardRecord]) {
                         $(`#upperLift`).append(`<tr class="animated"><td>${circle}</td><td>${datacardRecord}</td><td>${dataCardResponse.records[datacardRecord][key].validity}</td><td>${dataCardResponse.records[datacardRecord][key].desc}</td><td><button type="button" class="btn btn-primary plannerBestButton plannerBestButtonDataCard" key="${datacardRecord}" id="${dataCardResponse.records[datacardRecord][key].rs}" data-dismiss="modal">Rs. ${dataCardResponse.records[datacardRecord][key].rs}</button></td></tr>`);
                    }
                 }
             }
        })
        // jQuery.noConflict();
        $('.model_for_recharge_plan').modal('show');
     }
   }else if(elementId == "checkGasBill"){
     $('.plan-and-operator').html('');
     const elementId = $(this).attr('id');
     const customerGasNo = $('#GasCustomerNo').val();
     const operator = $('#gasOperator').val();
    if(!operator){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select gas operator</center></h6></center>`)
        $('#errorModalCenter').modal('show');
     }else if(!customerGasNo){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please enter customer id</center></h6>`)
        $('#errorModalCenter').modal('show');
     }else{
        $('#errorMsg').html('');
        $.get(`/getplan?customerGasNo=${customerGasNo}&operator=${operator}&type=${elementId}`,{},(res)=>{
          $('.plan-and-operator').append(`Browse Bill Detail of ${operator} - ${customerGasNo}`);
          const gasResponse = JSON.parse(res);

          $('#listOfOfferData').html('');
          $('#listOfOfferData').append(`<table class="table table-striped" id="upperTabFab" style="color:black">
          <thead class="thead-dark">
            <tr>
                <th scope="col">Customer Name</th>
                <th scope="col">Customer Id</th>
                <th scope="col">Bill Amount</th>
                <th scope="col">Due Amount</th>
                <th scope="col">Due Date</th>
                <th scope="col"></th>
            </tr>
          </thead>
          <tbody id="upperLift" class="tabFiled">

          </tbody>
          </table>
          `);
          $('#listOfOffer').html('');
          $('#listOfOffer').append(`<li class="innerPlan active" style="text-transform:uppercase;cursor:pointer">
                                    <b>BillCheck</b>
                                    </li>`);


             $(`#upperLift`).append(`
              <tr class="animated"><td>${gasResponse.records.CustomerName}</td><td>${gasResponse.tel}</td><td>${gasResponse.records.BillAmount}</td><td>${gasResponse.records.DueAmt}</td><td>${gasResponse.records.Duedate}</td><td><button type="button" id="${gasResponse.records.DueAmt}" key="${gasResponse.tel}" class="btn btn-primary plannerBestButton plannerBestButtonGas" data-dismiss="modal">Pay</button></td></tr>`);

        })
        // jQuery.noConflict();
        $('.model_for_recharge_plan').modal('show');
      }
   }else if(elementId == "viewElectricBill"){
     $('.plan-and-operator').html('');
     const elementId = $(this).attr('id');
     const serviceNo = $('#serviceNo').val();
     const operator = $('#electriCity').val();
    if(!operator){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please select your electricity operator</center></h6></center>`)
        $('#errorModalCenter').modal('show');
     }else if(!serviceNo){
        $('#errorMsg').html('');
        $('#errorMsg').append(`<h6><center style="color:black;font-weight:30px;">please enter customer id or service no</center></h6>`)
        $('#errorModalCenter').modal('show');
     }else{
        $('#errorMsg').html('');
        $.get(`/getplan?serviceNo=${serviceNo}&operator=${operator}&type=${elementId}`,{},(res)=>{
        $('.plan-and-operator').append(`Browse Bill Detail of ${operator} - ${serviceNo}`);
        const getElectricResponse = JSON.parse(res);
        $('#listOfOfferData').html('');
        $('#listOfOfferData').append(`<table class="table table-striped" id="upperTabFab" style="color:black">
        <thead class="thead-dark">
          <tr>
              <th scope="col">Customer Name</th>
              <th scope="col">Customer Id</th>
              <th scope="col">Bill Amount</th>
              <th scope="col">Bill Date</th>
              <th scope="col">Due Date</th>
              <th scope="col"></th>
          </tr>
        </thead>
        <tbody id="upperLift" class="tabFiled">

        </tbody>
        </table>
        `);
        $('#listOfOffer').html('');
        $('#listOfOffer').append(`<li class="innerPlan active" style="text-transform:uppercase;cursor:pointer">
                                  <b>BillCheck</b>
                                  </li>`);

            for (var getElectricRecords in getElectricResponse.records) {
                    $(`#upperLift`).append(`
                     <tr class="animated"><td>${getElectricResponse.records[getElectricRecords].CustomerName}</td><td>${getElectricResponse.tel}</td><td>${getElectricResponse.records[getElectricRecords].Billamount}</td><td>${getElectricResponse.records[getElectricRecords].Billdate}</td><td>${getElectricResponse.records[getElectricRecords].Duedate}</td><td><button type="button" key="${getElectricResponse.tel}" id="${getElectricResponse.records[getElectricRecords].Billamount}" class="btn btn-primary plannerBestButton plannerBestButtonElectric" data-dismiss="modal">Pay</button></td></tr>`);
            }

        })
        // jQuery.noConflict();
        $('.model_for_recharge_plan').modal('show');
      }
   }
  });
  // SCRIPT FOR MOBILE RUPEES BUTTON START
  $(document).on('click','.plannerBestButton',function(){
     var RechargeAmountByPlan = $(this).attr('id')
     var planType = $(this).attr('key')
     $('#mobileNoOfPrepaid').val(RechargeAmountByPlan)
     $('#typeofmobile').val(planType)
  });
  // SCRIPT FOR MOBILE RUPEES BUTTON extends

  // SCRIPT FOR DTH RUPEES BUTTON START
  $(document).on('click','.plannerBestButtonDth',function(){
     var RechargeDthAmountByPlan = $(this).attr('id')
     var planType = $(this).attr('key')
     $('#dthAmount').val(RechargeDthAmountByPlan)
     $('#tyeofdth').val(planType)
  });
  // SCRIPT FOR DTH RUPEES BUTTON extends

  // SCRIPT FOR DATACARD RUPEES BUTTON START
  $(document).on('click','.plannerBestButtonDataCard',function(){
     var RechargeDataCardAmountByPlan = $(this).attr('id')
     var planType = $(this).attr('key')
     $('#dataCardAmount').val(RechargeDataCardAmountByPlan)
     $('#tyeofdatacard').val(planType)
  });
  // SCRIPT FOR DATACARD RUPEES BUTTON extends

  // SCRIPT FOR GAS RUPEES BUTTON START
  $(document).on('click','.plannerBestButtonGas',function(){
     var GasAmountByPlan = $(this).attr('id')
     var planType = $(this).attr('key')
     $('#GasAmount').val(GasAmountByPlan)
     $('#tyeofgas').val(planType)
  });
  // SCRIPT FOR Gas RUPEES BUTTON extends

  // SCRIPT FOR Electric RUPEES BUTTON START
  $(document).on('click','.plannerBestButtonElectric',function(){
     var ElectricAmountByPlan = $(this).attr('id')
     var planType = $(this).attr('key')
     $('#electricAmount').val(ElectricAmountByPlan)
     $('#typeofelectric').val(planType)
  });
  // SCRIPT FOR Electric RUPEES BUTTON extends

});
</script>
<!-- SCRIPT FOR MOBILE START -->
<script>
function openDynamo(dynamoName) {
var i;
var x = document.getElementsByClassName("table");
for (i = 0; i < x.length; i++) {
  x[i].style.display = "none";
}
document.getElementById(dynamoName).style.display = "block";
}
</script>
<!-- SCRIPT FOR MOBILE END -->
<!-- SCRIPT FOR DTH START -->
<script>
function openDthDynamo(dynamoName) {
var i;
var x = document.getElementsByClassName("table");
for (i = 0; i < x.length; i++) {
  x[i].style.display = "none";
}
document.getElementById(dynamoName).style.display = "block";
}
</script>
<script>
$(document).ready( function () {
    $('.myTable').DataTable();
} );
</script>
