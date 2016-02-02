<?php if (isset($_GET['industry'])) {
$u_category = $_GET['industry'];
} ?>
  <div class="box col-md-12 col-sm-12 col-xs-12 font-lato" >
    
      
      <div class="hidden-lg hidden-md"><hr class=""/></div>
            
      <?php
      /*---------------Calling Rss feed---------------*/
      $force_url = "rss.xml";
      $xml = simplexml_load_file($force_url);
      //Count all live jobs jobs
      $number_of_jobs = count($xml->channel->item);
      $all_jobs = array($xml->channel);
      ?>

       <!--output jobs-->
      <div id='results_column_headers' class='box-blue hidden-sm hidden-xs' >
        <h4 class='col-md-6 col-lg-6 '>Job Title</h4>
          <h4 class='col-md-2 col-lg-2'>Job Location</h5>
          <h4 class='col-md-3 col-lg-3 '>Salary / Hourly Rate</h5>
            <br><br>
      </div>
        <?php 
          $html = "";

          $display_count =0;
           for ($i=0; $i < $number_of_jobs ; $i++) { 

              $job_department = $xml->channel->item[$i]->ts2__Department__c; //job department
              $job_location = $xml->channel->item[$i]->ts2__Location__c; //location

              $jobtitle = $xml->channel->item[$i]->title; // RSS_Job_Title__c; jobtitle
              $s_description  = $xml->channel->item[$i]->ts2__Short_Description__c; //short description
              $job_number = $xml->channel->item[$i]->ts2__Job_Number__c; //job number
              
              $job_country = $xml->channel->item[$i]->Job_Country__c; //location
              $job_city = $xml->channel->item[$i]->Job_City__c; //city
              $pub_date =$xml->channel->item[$i]->pubDate; //publish Date
             
              $min_pay_rate =$xml->channel->item[$i]->ts2__Min_Pay_Rate__c; //temp pay min
              $max_pay_rate  =$xml->channel->item[$i]->ts2__Max_Pay_Rate__c; //temp pay max
              $min_salary =$xml->channel->item[$i]->ts2__Min_Salary__c; //perm pay min
              $max_salary  =$xml->channel->item[$i]->ts2__Max_Salary__c; //perm pay max
              $payment_type=$xml->channel->item[$i]->RSS_Record_Type__c; //Job type: Temp or Perm
              $currency=$xml->channel->item[$i]->CCurrency__c; //Job type: Temp or Perm

              /*---------------Remove spec job---------------*/
              if ($job_number != 'JO-1501-2406') {

              /*---------------if currency is empty---------------*/
              if ($currency =="" || $currency == " " || is_null($currency) || !isset($currency)) {
                $currency = "EUR";
              }
              /*---------------Check for job type---------------*/
              if (isset($payment_type) && $payment_type == "Temp") {
                $pay_max=$max_pay_rate;
                $pay_min=$min_pay_rate;
                $payment_type="Range ";
                $job_type ="Contract";
                $payment_rule = "Per Hour.";
              }

              if (isset($payment_type) && $payment_type == "Perm") {
                $pay_max=$max_salary;
                $pay_min=$min_salary;
                $pay ="";
                $payment_type="Salery";
                $job_type ="Perm";
                $payment_rule = "";
              }

              $jobtitle_clean_url = str_replace(" ", "-", $jobtitle);

              /*Format Numbers*/
              $pay_max = round($pay_max);
              $pay_min = round($pay_min);
              $pay_max = number_format($pay_max);
              $pay_min = number_format($pay_min);
              
              /* Set Payment*/

              // if both fields are set and are a range
              $payment = "$currency $pay_min - $pay_max <span class='payment-rule'>$payment_rule</span>";

              // if payment has no range
              if ($pay_min == 0 && $pay_max != 0) {
                $payment = "$currency $pay_max <span class='payment-rule'>$payment_rule</span>";
              }
               if ($pay_max == 0 && $pay_min != 0) {
                $payment = "$currency $pay_min <span class='payment-rule'>$payment_rule</span>";
              }
              if ($pay_max == $pay_min) {
                 $payment = "$currency $pay_max <span class='payment-rule'>$payment_rule</span>";
              }

              //if payment is NEG
              if  ($pay_max ==0 && $pay_min ==0) {
                  $payment = "Negotiable";
              }

              if ($job_country == "" || $job_country == null || $job_country ==" ") {
                $job_country = "none";
              }
               /*---------------Category Only---------------*/
               if (isset($u_category)) {

                    if ($job_department == $u_category ) {
                     echo "
                  <div class='box-result box-search-resutls'>
                  
                        <h3 class='col-md-6 col-lg-6'>$jobtitle</h3>
                        <h4 class='col-md-2 col-lg-2'>$job_location</h4>
                        <h4 class='col-md-3 col-lg-3'>$payment</h4> 
                        <a class='btn btn-warning flat-corners col-md-1 col-lg-1 col-xs-6 col-sm-6' href='job-details/$jobtitle_clean_url/$job_country/$job_number'><h4>Apply</h4></a>
                        <br /> <br />
                  </div>";
                   $display_count++;
                    }
               }
             }
            }
           
        ?>
    
  </div>

