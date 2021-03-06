<?php
 if (isset($u_keywords)) {
      
       


      /*---------------Calling Rss feed---------------*/
      $force_url = "rss.xml";
      $xml = simplexml_load_file($force_url);
      //Count all live jobs jobs
      $number_of_jobs = count($xml->channel->item);
      $all_jobs = array($xml->channel);

      
        
    
    
      /*---------------Creating Heading ---------------*/
        $heading = "Amgen Jobs";
        ?>
        <div class='box-blue hidden-sm hidden-xs' >
          <h4 class='col-md-6 col-lg-6 '>Job Title</h4>
          <h4 class='col-md-2 col-lg-2'>Job Location</h5>
          <h4 class='col-md-3 col-lg-3 '>Salary / Hourly Rate</h5>
          <br><br>
        </div>
     <!--output jobs-->
    
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

               $jobtitle_clean_url = str_replace(" ", "-", $jobtitle);
               $jobtitle_clean_url = str_replace("&", "and", $jobtitle_clean_url);
               $jobtitle_clean_url = str_replace("  ", "-", $jobtitle_clean_url);
               $jobtitle_clean_url = str_replace(" ", "-", $jobtitle_clean_url);

              if ($job_country == "" || $job_country == null || $job_country ==" ") {
                $job_country = "none";
              }
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
                $payment_rule = "Per Hour";
              }

              if (isset($payment_type) && $payment_type == "Perm") {
                $pay_max=$max_salary;
                $pay_min=$min_salary;
                $pay ="";
                $payment_type="Salery";
                $job_type ="Perm";
                $payment_rule = "";
              }
             
              /*Format Numbers*/
              $pay_max = round($pay_max);
              $pay_min = round($pay_min);
              $pay_max = number_format($pay_max);
              $pay_min = number_format($pay_min);
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

              /*---------------keywords Only---------------*/
              if (isset($u_keywords) && $u_keywords != "") {
                $lc_s_description = strtolower($s_description); //Lower case variable
                $lc_u_keywords = strtolower($u_keywords);//Lower case variable
                $lc_jobtitle = strtolower($jobtitle);//Lower case variable
               $u_keywords_array = explode(" ",$lc_u_keywords); //turning search string into array of keywords
                  foreach ($u_keywords_array as $keyword) { //looping through keywords array
                     if (strpos($lc_s_description,$keyword) !== false || strpos($lc_jobtitle,$keyword) !== false) { // searching for each keyword againt rss feed 

                       $s_description = str_replace($keyword, "<span class='highlight'>$keyword</span>", $s_description);
                       $jobtitle = str_replace($keyword, "<span class='highlight'>$keyword</span>", $jobtitle);
                       
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

              

           } //END FOR LOOP
          
          if ($display_count == 0) {
            echo "<div class='box'><h3 class='text-center'>No jobs to display at this time, please try another Query</h3></div>";
          }
          /*
      if ($display_count != 1) {
       echo "$display_count jobs";
      }else echo"$display_count job";
      */
       
         ?>
      </div>
     
      <?php 
      }else{exit();}
      ?>
      



  




