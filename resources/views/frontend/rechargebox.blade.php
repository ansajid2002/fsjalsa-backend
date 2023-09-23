<div id="mobile" class="city">
  <h6><center style="color:#80b435">Mobile Recharge</center></h6>
  <p>
  <form method="post" action="{{route('goForPayment')}}">
    @csrf
     <div class="form-group">
       <input type="text" name="mobileno" title="please enter a valid phone number your phone number is not correct" class="form-control" id="mobileNoforprepaid" pattern="[789][0-9]{9}" aria-describedby="emailHelp" placeholder="Enter Mobile No" required>
       <small id="emailHelp" class="form-text text-muted">We'll never share your details with anyone else.</small>
    </div>
    <div class="form-group">
      <select name="operator" class="form-control" required title="please select the operator" id="operatorOfPrepaid" aria-describedby="emailHelp">
        <option value="">Select Operator</option>
          <option value="Airtel">Airtel</option>
          <!-- <option value="Aircel">Aircel</option> -->
          <option value="Bsnl">Bsnl</option>
          <!-- <option value="Tata Docomo">Tata Docomo</option> -->
          <!-- <option value="Tata Indicom">Tata Indicom</option> -->
          <!-- <option value="Telenore">Telenore</option> -->
          <option value="Jio">Jio</option>
          <option value="Vodafone" selected>Vodafone</option>
          <option value="Idea">Idea</option>
          <!-- <option value="MTS">MTS</option> -->
          <!-- <option value="MTNL">MTNL</option> -->
      </select>
      <b><span style="color:#80b435;float:right"><span style="padding-right:8px;cursor:pointer;" class="view_plan" id="mobile_plan">view plan</span><span style="cursor:pointer;" class="view_plan" id="mobile_offer">view offer</span></span></b>
      <br>
    </div>
    <input type="hidden" name="payment_for_what" value="Mobile Prepaid">
    <input type="hidden" name="typeof" id="tyeofmobile">
      <input type="hidden" name="rectype" value="mobile">
    <div class="form-group">
      <select name="circle" class="form-control" required title="please select the circle" id="circleOfPrepaid" aria-describedby="emailHelp">
            <option value="">Select Cricle</option>
            <option value="Andhra Pradesh Telangana">Andhra Pradesh Telangana</option>
            <option value="Assam">Assam</option>
            <option value="Bihar Jharkhand">Bihar Jharkhand</option>
            <option value="Chennai">Chennai</option>
            <option value="Delhi NCR">Delhi NCR</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Haryana">Haryana</option>
            <option value="Himachal Pradesh">Himachal Pradesh</option>
            <option value="Jammu Kashmir">Jammu Kashmir</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Kerala">Kerala</option>
            <option value="Kolkata">Kolkata</option>
            <option value="Madhya Pradesh Chhattisgarh">Madhya Pradesh Chhattisgarh</option>
            <option value="Maharashtra Goa" selected>Maharashtra Goa</option>
            <option value="Mumbai">Mumbai</option>
            <option value="North East">North East</option>
            <option value="Orissa">Orissa</option>
            <option value="Punjab">Punjab</option>
            <option value="Rajasthan">Rajasthan</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
            <option value="UP East">UP East</option>
            <option value="UP West">UP West</option>
            <option value="West Bengal">West Bengal</option>
      </select>
    </div>
   <div class="form-group">
      <input readonly type="text" pattern="[0-9]+" title="please enter number not text" min="1" max="10000" name="amount" class="form-control" id="mobileNoOfPrepaid" aria-describedby="emailHelp" placeholder="Enter Amount" required>
    </div>
  <br>
      <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
  </form>
</p>
</div>

<div id="dth" class="city" style="display:none">
    <h6><center style="color:#80b435">DTH Recharge</center></h6>
    <p>
    <form method="post" action="{{route('goForPayment')}}">
      @csrf
         <div class="form-group">
          <input type="text" name="mobileno" title="please enter a valid dth number your dth number is not correct" class="form-control" id="exampleInputEmail1" min="10" max="10" pattern="[0-9]+" aria-describedby="emailHelp" placeholder="Enter VC No/Smart Card/ Subscriber No/Customer Id/Mobile No" required>
          <small id="emailHelp" class="form-text text-muted" style="color:green">(Enter VC No/ Smart Card/ Subscriber No/ Customer Id/ Mobile No)</small>
          <br>
          <small id="emailHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
        </div>
      <div class="form-group">
        <select name="operator" class="form-control" required title="please select the circle" id="operatorOfDth" aria-describedby="emailHelp">
                <option value="">Select Operator</option>
                <option value="Airtel dth">Airtel Digital TV</option>
                <option value="Dish TV">Dish TV</option>
                <option value="Tata Sky">TATA Sky</option>
                <!-- <option value="Sun Direct">Sun Direct</option> -->
                <option value="Videocon">Videocon D2H</option>
        </select>
        <b><span style="color:#80b435;float:right"><span style="padding-right:8px;cursor:pointer;" class="view_plan" id="dth_plan">view plan</span></span></b>
       <br>
      </div>
      <input type="hidden" name="payment_for_what" value="DTH Recharge">
      <input type="hidden" name="typeof" id="tyeofdth">
      <input type="hidden" name="rectype" value="dth">
     <div class="form-group">
        <input readonly type="text" pattern="[0-9]+" title="please enter number not text" min="1" max="10000" name="amount" class="form-control" id="dthAmount" aria-describedby="emailHelp" placeholder="Enter Amount" required>
     </div>
    <br>
        <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
        <br>
      </form>
    </p>
  </div>
  <div id="datacard" class="city" style="display:none">
    <h6><center style="color:#80b435">Datacard Recharge</center></h6>
    <p>
    <form action="{{route('goForPayment')}}" method="post">
      @csrf
       <div class="form-group">
        <input type="text" name="mobileno" min="10" max="10" title="please enter a valid mobile number your mobile number is not correct" class="form-control" id="dataCardMobileno" pattern="[0-9]+" aria-describedby="emailHelp" placeholder="Enter Mobile No" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your detail with anyone else.</small>
      </div>
      <div class="form-group">
        <select name="operator" class="form-control" required title="please select the operator" id="dataCardOperator" aria-describedby="emailHelp">
          <option value="">select operator</option>
          <option value="Airtel">Airtel</option>
          <option value="Bsnl">BSNL</option>
          <option value="Jio">Jio</option>
          <option value="Idea">Idea</option>
          <!-- <option value="MTNL">MTNL</option> -->
          <option value="Vodafone">Vodafone</option>
          <!-- <option value="Vodafone Idea">Vodafone Idea</option> -->
        </select>
        <b><span style="color:#80b435;float:right"><span style="padding-right:8px;cursor:pointer;" class="view_plan" id="dataCard">view plan</span></span></b>
        <br>
      </div>
      <div class="form-group">
        <select name="circle" class="form-control" required title="please select the circle" id="dataCardCircle" aria-describedby="emailHelp">
          <option value="">Select Cricle</option>
          <option value="Andhra Pradesh Telangana">Andhra Pradesh Telangana</option>
          <option value="Assam">Assam</option>
          <option value="Bihar Jharkhand">Bihar Jharkhand</option>
          <option value="Chennai">Chennai</option>
          <option value="Delhi NCR">Delhi NCR</option>
          <option value="Gujarat">Gujarat</option>
          <option value="Haryana">Haryana</option>
          <option value="Himachal Pradesh">Himachal Pradesh</option>
          <option value="Jammu Kashmir">Jammu Kashmir</option>
          <option value="Karnataka">Karnataka</option>
          <option value="Kerala">Kerala</option>
          <option value="Kolkata">Kolkata</option>
          <option value="Madhya Pradesh Chhattisgarh">Madhya Pradesh Chhattisgarh</option>
          <option value="Maharashtra Goa" selected>Maharashtra Goa</option>
          <option value="Mumbai">Mumbai</option>
          <option value="North East">North East</option>
          <option value="Orissa">Orissa</option>
          <option value="Punjab">Punjab</option>
          <option value="Rajasthan">Rajasthan</option>
          <option value="Tamil Nadu">Tamil Nadu</option>
          <option value="UP East">UP East</option>
          <option value="UP West">UP West</option>
          <option value="West Bengal">West Bengal</option>
        </select>
      </div>
     <div class="form-group">
        <input readonly type="text" pattern="[0-9]+" title="please enter number not text" min="1" max="10000" name="amount" class="form-control" id="dataCardAmount" aria-describedby="emailHelp" placeholder="Enter Amount" required>
     </div>
     <input type="hidden" name="payment_for_what" value="Datacard Recharge">
     <input type="hidden" name="typeof" id="tyeofdatacard">
     <input type="hidden" name="rectype" id="rectype" value="datacard">
    <br>
        <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
      <br>
    </form>
  </p>
  </div>

  <div id="landline" class="city" style="display:none">
    <h6><center style="color:#80b435">Pay Your Landline/Broadband Bill</center></h6>
    <p>
    <form>
      <div class="form-group">
        <select name="operator" class="form-control" required title="please select the circle" id="exampleInputEmail1" aria-describedby="emailHelp">
          <option value="">Select Operator</option>
          <option value="ACT Broadband">ACT Broadband</option>
          <option value="ANI Network">ANI Network</option>
          <option value="Airtel">Airtel</option>
          <option value="Alliance Broadband">Alliance Broadband</option>
          <option value="Asianet Broadband">Asianet Broadband</option>
          <option value="BSNL">BSNL</option>
          <option value="Comway Broadband">Comway Broadband</option>
          <option value="Connect">Connect</option>
          <option value="Den Broadband">Den Broadband</option>
          <option value="Dreamtel Broadband">Dreamtel Broadband</option>
          <option value="Excell Broadband">Excell Broadband</option>
          <option value="Flash Fibernet">Flash Fibernet</option>
          <option value="Foxtel Broadband">Foxtel Broadband</option>
          <option value="Fusionnet">Fusionnet</option>
          <option value="GBPS Broadband">GBPS Broadband</option>
          <option value="GTPL Broadband">GTPL Broadband</option>
          <option value="Hathway Broadband">Hathway Broadband</option>
          <option value="INSTALINKS">INSTALINKS</option>
          <option value="ION">ION</option>
          <option value="Instanet Broadband">Instanet Broadband</option>
          <option value="MTNL Delhi">MTNL Delhi</option>
          <option value="MTNL Mumbai">MTNL Mumbai</option>
          <option value="Mach1 Broadband">Mach1 Broadband</option>
          <option value="Meghbela">Meghbela</option>
          <option value="Microscan">Microscan</option>
          <option value="Mnet Broadband">Mnet Broadband</option>
          <option value="Netplus Broadband">Netplus Broadband</option>
          <option value="Nextra Broadband">Nextra Broadband</option>
          <option value="ONE Broadband">ONE Broadband</option>
          <option value="Praction Network">Praction Network</option>
          <option value="SPECTRA">SPECTRA</option>
          <option value="Sikka Broadband">Sikka Broadband</option>
          <option value="Siti Broadband">Siti Broadband</option>
          <option value="TTN Broadband">TTN Broadband</option>
          <option value="Tata Sky Broadband">Tata Sky Broadband</option>
          <option value="Tata Tele Broadband">Tata Tele Broadband</option>
          <option value="Tikona Broadband">Tikona Broadband</option>
          <option value="Timbl Broadband">Timbl Broadband</option>
          <option value="UCN Broadband">UCN Broadband</option>
          <option value="Vfibernet Broadband">Vfibernet Broadband</option>
          <option value="YOU Broadband">YOU Broadband</option>
          </select>
      </div>
       <div class="form-group">
        <input type="text" name="custidno" title="please enter a valid detail your detail is not correct" required class="form-control" id="exampleInputEmail1" pattern="" aria-describedby="emailHelp" placeholder="Enter Customer Id/Subscriber id etc" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your detail with anyone else.</small>
      </div>
        <br>
        <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
      <br>
    </form>
  </p>
  </div>

  <div id="gas" class="city" style="display:none">
    <h6><center style="color:#80b435">Pay Gas Bill</center></h6>
    <p>
    <form method="post" action="">
      @csrf
      <div class="form-group">
        <select name="operator" class="form-control" required title="please select the circle" id="gasOperator" aria-describedby="emailHelp">
          <option  value="">Gas Operator</option>
          <option  value="ADGL">Adani Gas</option>
          <option  value="AVGL">Avantika Gas</option>
          <option  value="CUGL">Centerl UP Gas</option>
          <option  value="CHGL">Charoter Gas</option>
            <option  value="GJGL">Gujarat Gas</option>
            <option  value="HCGL">Haryana City  Gas</option>
            <option  value="IOGL">Indian Oil Gas</option>
            <option  value="IPGL">Indraprashtha Gas</option>
            <option  value="MHGL">Mahanagar Gas</option>
            <option  value="MNGL">Maharastra Natural Gas</option>
            <option  value="SBGL">Sabarmati Gas UP</option>
            <option value="SIGL">Siti Gas UP</option>
            <option  value="TNGL">Tripura Natural Gas</option>
            <option  value="UCPG">Unique Central Piped Gas</option>
            <option  value="VDGL">Vadodara Gas</option>
        </select>
      </div>
       <div class="form-group">
        <input type="text" name="customerno" title="please enter a valid customer number your customer number is not correct" required class="form-control" id="GasCustomerNo" pattern="[0-9]+" aria-describedby="emailHelp" placeholder="Enter Customer No" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your detail with anyone else.</small>
          <b><span style="color:#80b435;float:right"><span style="padding-right:8px;cursor:pointer;" class="view_plan" id="checkGasBill">check bill</span></span></b>

      </div>
      <br>
      <input type="hidden" name="payment_for_what" value="Gas Payment">
      <input type="hidden" name="typeof" id="tyeofgas">
       <div class="form-group">
        <input readonly type="text" name="amount" value="5154" title="please enter a valid amount your amount is not correct" required class="form-control" id="GasAmount" pattern="[0-9]+" aria-describedby="emailHelp" placeholder="Enter Amount" required>
      </div>
        <br>
        <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
      <br>
    </form>
  </p>
  </div>
  <div id="water" class="city" style="display:none">
    <h6><center style="color:#80b435">Pay Your Water Bill</center></h6>
    <p>
    <form>
      <div class="form-group">
        <select name="operator" class="form-control" required title="please select the circle" id="exampleInputEmail1" aria-describedby="emailHelp">
          <option data-tokens="Water Operator">Water Operator</option>
                  <option data-tokens="ADGL">Ahmedabad Municipal Corporation</option>
                  <option data-tokens="AVGL">Bangalore Water Supply and Sewerage Board</option>
                  <option data-tokens="CUGL">Bhopal Municipal Corporation - Water</option>
                  <option data-tokens="CHGL">Delhi Development Authority (DDA) - Water</option>
                  <option data-tokens="GJGL">Delhi Jal Board</option>
                  <option data-tokens="GJGL">Department of Public Health Engineering-Water, Mizoram</option>
                <option data-tokens="GJGL">Greater Warangal Municipal Corporation - Water</option>
                <option data-tokens="GJGL">Gwalior Municipal Corporation - Water</option>
                <option data-tokens="GJGL">Hyderabad Metropolitan Water Supply and Sewerage Board</option>
                <option data-tokens="GJGL">Indore Municipal Corporation - Water</option>
                <option data-tokens="GJGL">Jabalpur Municipal Corporation - Water</option>
                <option data-tokens="GJGL">Municipal Corporation Jalandhar</option>
                <option data-tokens="GJGL">Municipal Corporation Ludhiana - Water</option>
                <option data-tokens="GJGL">Municipal Corporation of Amritsar</option>
                <option data-tokens="GJGL">Municipal Corporation of Gurugram</option>
                <option data-tokens="GJGL">Mysuru City Corporation</option>
                <option data-tokens="GJGL">New Delhi Municipal Council (NDMC) - Water</option>
                <option data-tokens="GJGL">Pimpri Chinchwad Municipal Corporation(PCMC)</option>
                <option data-tokens="GJGL">Pune Municipal Corporation - Water</option>
                <option data-tokens="GJGL">Ranchi Municipal Corporation</option>
                <option data-tokens="GJGL">Silvassa Municipal Council</option>
                <option data-tokens="GJGL">Surat Municipal Corporation - Water</option>
                <option data-tokens="GJGL">Ujjain Nagar Nigam - PHED</option>
                <option data-tokens="GJGL">Urban Improvement Trust (UIT) - Bhiwadi</option>
                <option data-tokens="GJGL">Urban Improvement Trust (UIT) - Bhiwadi - Old</option>
                <option data-tokens="GJGL">Uttarakhand Jal Sansthan</option>
          </select>
      </div>
       <div class="form-group">
        <input type="text" name="cusacc_no" title="please enter a valid detail your detail is not correct" required class="form-control" id="exampleInputEmail1" pattern="" aria-describedby="emailHelp" placeholder="Enter Customer Account No" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your detail with anyone else.</small>
      </div>
        <br>
        <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
      <br>
    </form>
  </p>
  </div>
  <div id="insurance" class="city" style="display:none">
    <h6><center style="color:#80b435">Pay your Insurance Premium</center></h6>
    <p>
    <form>
      <div class="form-group">
        <select name="operator" class="form-control" required title="please select the circle" id="exampleInputEmail1" aria-describedby="emailHelp">
          <option data-tokens="Insurance Operator">Insurance Operator</option>
                        <option value="LICOF">Life Insurance Corporation of India</option>
                        <option value="ABSL">Aditya Birla Sun Life Insurance</option>
                        <option value="AVLI">UttarGujarat Vij Company Ltd</option>
                        <option value="BALI">Bajaj Allianz Life Insurance</option>
                        <option value="AXLI">Bharti AXA Life Insurance</option>
                        <option value="CHOL">Canara HSBC OBC Life Insurance</option>
                        <option value="ETLI">Edelweiss Tokio Life Insurance</option>
                        <option value="EXLI">Exide Life Insurance</option>
                        <option value="FGIL">Future Generali India Life Insurance Company Limited</option>
                        <option value="HDFC">HDFC Life Insurance</option>
                        <option value="ICIC">ICICI Prudential Life Insurance</option>
                        <option value="IDBI">IDBI Federal Life Insurance</option>
                        <option value="IFLI">IndiaFirst Life Insurance</option>
                        <option value="MAXL">Max Life Insurance</option>
                        <option value="PNBM">PNB MetLife Insurance</option>
                        <option value="PRLI">Pramerica Life Insurance</option>
                        <option value="RNLI">Reliance Nippon Life Insurance</option>
                        <option value="SBIL">SBI Life Insurance</option>
                        <option value="SLIC">Shriram Life Insurance Co Ltd</option>
                        <option value="SUDI">Star Union Dai Ichi Life Insurance</option>
                        <option value="TALI">Tata AIA Life Insurance</option>
          </select>
      </div>
       <div class="form-group">
        <input type="text" name="cusacc_no" title="please enter a valid detail your detail is not correct" required class="form-control" id="exampleInputEmail1" pattern="" aria-describedby="emailHelp" placeholder="Enter Customer Account No" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your detail with anyone else.</small>
      </div>
        <br>
        <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
      <br>
    </form>
  </p>
  </div>
  <div id="electricity" class="city" style="display:none">
    <h6><center style="color:#80b435">Pay For Electricity</center></h6>
    <p>
    <form action="" method="post">
      @csrf
      <div class="form-group">
        <select name="operator" class="form-control" required title="please select the circle" id="electriCity" aria-describedby="emailHelp">
          <option value="">Select Operator</option>
          <option value="PGVCL">Paschim Gujarat <br>Vij Company Ltd</option>
          <option value="DGVCL">Dakshin Gujarat <br>Vij Company Ltd</option>
          <option value="UGVCL">UttarGujarat Vij<br> Company Ltd</option>
          <option value="MGVCL">Madhya Gujarat <br>Vij Company Ltd</option>
          <option value="MSEDCL">Maharashtra State <br>Electricity Distribution</option>
          <option value="RELIANCE">Reliance Energy</option>
          <option value="PSPCL">Punjab State <br>Power Corporation Limted</option>
          <option value="UPPCL">Uttar Pradesh <br>Power Corporation Limited</option>
          <option value="TATA">Tata Power</option>
          <option value="UHBVN">Uttar Haryana <br>Bijli Vitran Nigam</option>
          <option value="DHBVN">Dakshin Haryana <br>Bijli Vitran Nigam</option>
          <option value="TORRENTSURAT">Torrent Power Surat</option>
          <option value="TORRENTAHME">Torrent Power Ahemdabad</option>
          <option value="TORRENTDAHEJ">Torrent Power Dahej</option>
          <option value="TORRENTBHIVA">Torrent Power Bhivandi</option>
          <option value="TORRENTAGRA">Torrent Power Agra</option>
          <option value="BESTMUMBAI">BEST Mumbai</option>
          <option value="BESCOM">Bangalore Electricity Supply<br> Company Ltd. (BESCOM)</option>
          <option value="CESCOM">Chamundeshwari Electricity <br>Supply Corporation Ltd. (Cesc,Mysore)</option>
          <option value="GESCOM">Gulbarga Electricity Supply <br>Company Ltd. (GESCOM)</option>
          <option value="HESCOM">Hubli Electricity Supply <br>Company Ltd. (HESCOM)</option>
          <option value="MESCOM" disabled="">Mangalore Electricity <br>Supply Company Ltd. (MESCOM) soon</option>
          <option value="MPPKVVCL">Madhya Pradesh Paschim Kshetra <br>Vidyut Vitaran Company Ltd</option>
          <option value="MPPKVVCLPUU">MP Poorv Kshetra <br>Vidyut Vitaran - Jabalpur</option>
          <option value="MPPKVVCLPUR">MP Poorv Kshetra <br>Vidyut Vitaran - Rular</option>
          <option value="MPPKVVCL"> MP Madhya Kshetra<br> Vidyut Vitran - Bhopal</option>
          <option value="MSEDCL"> Mahavitaran-Maharashtra State <br>Electricity Distribution Company Ltd.</option>
          <option value="HPSEBL"> Himachal Pradesh State <br>Electricity Board Ltd</option>
          <option value="NBPDCL">North Bihar Power<br> Distribution</option>
          <option value="SBPDCL"> South Bihar <br>Power Distribution</option>
          <option value="KEDL"> Bharatpur Electricity<br> Services Ltdi</option>
          <option value="KEDL"> Bikaner Electricity <br>Supply Limited</option>
          <option value="KEDL">Kota Electricity<br> Distribution Ltd</option>
          <option value="JVVNL"> Jaipur Vidyut <br>Vitran Nigam Ltd</option>
          <option value="AVVNL">Ajmer Vidyut <br>Vitran Nigam Ltd</option>
          <option value="JDVVNL">Jodhpur Vidyut<br> Vitran Nigam Ltd</option>
          <option value="TPADL">TP Ajmer <br>Distribution Ltd</option>
          <option value="KSEB"> Kerala State <br>Electricity Board Ltd.</option>
          <option value="APSPDCL">Eastern Power Distribution <br>Company of Andhra Pradesh Ltd.</option>
          <option value="APEPDCL">Southern Power Distribution <br>Company of A.P Ltd</option>
          <option value="WBSEEDCL">West Bengal State <br>Electricity Distribution Company Limited</option>
          <option value="TNEB">Tamil Nadu <br>Electricity Board</option>
          <option value="NRAPDR">Assam Power <br>Distribution Company Ltd (NON-RAPDR)</option>
          <option value="RAPDR">Assam Power <br>Distribution Company Ltd (RAPDR)</option>
          <option value="BSESR">BSES Rajdhani - Delhi</option>
          <option value="BSESY">BSES Yamuna - Delhi</option>
          <option value="CESC">Calcutta Electric <br>Supply Corporation (CESC)</option>
          <option value="CSPDCL">Chhattisgarh State<br> Power Distribution Company Ltd</option>
          <option value="DNHPDCL">DNH Power <br>Distribution Company Limited</option>
          <option value="DNDE">Daman and Diu<br> Electricity</option>
          <option value="KESCO">Kanpur Electricity <br>Supply Company</option>
          </select>
      </div>
      <input type="hidden" name="payment_for_what" value="Electricity Payment">
      <input type="hidden" name="typeof" id="typeofelectric">
       <div class="form-group">
        <input type="text" name="customer_accno" title="please enter a valid customer account number your customer account number is not correct" required class="form-control" id="serviceNo" pattern="[0-9]+" aria-describedby="emailHelp" placeholder="Enter Customer Account No/Service No" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your detail with anyone else.</small>
          <b><span style="color:#80b435;float:right"><span style="padding-right:8px;cursor:pointer;" class="view_plan" id="viewElectricBill">view bill</span></span></b>
      </div>
      <br>
       <div class="form-group">
        <input readonly type="text" name="amount" title="please enter a valid amount your amount is not correct" required class="form-control" id="electricAmount" pattern="[0-9]+" aria-describedby="emailHelp" placeholder="Enter Amount" required>
      </div>
        <br>
        <center><button type="submit" class="btn btn-primary" style="background:#80b435;color:white;border:none">Proceed</button></center>
      <br>
    </form>
  </p>
  </div>
  <script>
function openCitys(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
}
</script>
