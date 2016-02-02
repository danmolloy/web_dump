<?php


/*---------------Calling Rss feed---------------*/
$force_url = "rss.xml";
$xml = simplexml_load_file($force_url);
//Count all live jobs
$number_of_jobs = count($xml->channel->item);
/*---------------Setting Local Variables---------------*/


$header = "
<div id='results_column_headers' class='box-blue hidden-sm hidden-xs' >
<h4 class='col-md-6 col-lg-6 '>Job Title</h4>
<h4 class='col-md-2 col-lg-2'>Job Location</h5>
<h4 class='col-md-3 col-lg-3 '>Salary / Hourly Rate</h5>
<br><br>
</div>";
$results = array();

function add_result($ranking, $input) {
  //"title" => $jobtitle, "location" => $job_location, "payment => "$payment, "url" => $jobtitle_clean_url, "country" => $job_country, "jnum" => $job_number
  global $results;
  if ($input['jnum'] == 'JO-1501-2406') {
    return;
  }
  $result = "
  <a href='job-details/$input[url]/$input[country]/$input[jnum]'>
  <div class='box-result box-search-results'>
  <h3 class='col-md-6 col-lg-6'>$input[title]</h3>
  <h4 class='col-md-2 col-lg-2'>$input[location]</h4>
  <h4 class='col-md-3 col-lg-3'>$input[payment]</h4>
  <span class='btn btn-warning flat-corners col-md-1 col-lg-1 col-xs-12 col-sm-12'><h4>Apply</h4></span>
  <br /> <br />
  </div>
  </a>";
  //<a class='btn btn-warning flat-corners col-md-1 col-lg-1 col-xs-12 col-sm-12' href='job-details/$input[url]/$input[country]/$input[jnum]'><h4>Apply</h4></a>
  array_push($results, array($ranking => $result));
}


for ($i=0; $i < $number_of_jobs ; $i++) {

  $xml_ranking = 0;
  $xml_job_department = $xml->channel->item[$i]->ts2__Department__c; //job department
  $xml_job_location = $xml->channel->item[$i]->ts2__Location__c; //location
  $xml_jobtitle = $xml->channel->item[$i]->title; // RSS_Job_Title__c; jobtitle
  $xml_s_description  = $xml->channel->item[$i]->ts2__Short_Description__c; //short description
  $xml_job_number = $xml->channel->item[$i]->ts2__Job_Number__c; //job number
  $xml_job_description = $xml->channel->item[$i]->description;
  $xml_job_country = $xml->channel->item[$i]->Job_Country__c; //location
  $xml_job_city = $xml->channel->item[$i]->Job_City__c; //city
  $xml_pub_date =$xml->channel->item[$i]->pubDate; //publish Date
  $xml_min_pay_rate =$xml->channel->item[$i]->ts2__Min_Pay_Rate__c; //temp pay min
  $xml_max_pay_rate  =$xml->channel->item[$i]->ts2__Max_Pay_Rate__c; //temp pay max
  $xml_min_salary =$xml->channel->item[$i]->ts2__Min_Salary__c; //perm pay min
  $xml_max_salary  =$xml->channel->item[$i]->ts2__Max_Salary__c; //perm pay max
  $xml_payment_type=$xml->channel->item[$i]->RSS_Record_Type__c; //Job type: Temp or Perm
  $xml_currency=$xml->channel->item[$i]->CCurrency__c; //Job type: Temp or Perm
  $xml_titles=$xml->channel->item[$i]->Job_Titles__c; //Job type: Temp or Perm
  $xml_primary_title=$xml->channel->item[$i]->Primary_Job_Skill__c;
  $xml_titles_array = explode(";", $xml_titles);



  $xml_jobtitle_clean_url = str_replace([" ", "&", "/"], ["-", "and", ""], $xml_jobtitle);
  $xml_jobtitle_clean_url = preg_replace("/\xE2\x80\x8B/", "", $xml_jobtitle_clean_url);

  /*---------------if currency is empty---------------*/
  if ($xml_currency =="" || $xml_currency == " " || is_null($xml_currency) || !isset($xml_currency)) {
    $xml_currency = "EUR";
  }
  /*---------------Check for job type---------------*/
  if (isset($xml_payment_type) && $xml_payment_type == "Temp") {
    $xml_pay_max=$xml_max_pay_rate;
    $xml_pay_min=$xml_min_pay_rate;
    $xml_payment_type="Range ";
    $xml_job_type ="Contract";
    $xml_payment_rule = "Per Hour";
  }
  if (isset($xml_payment_type) && $xml_payment_type == "Perm") {
    $xml_pay_max=$xml_max_salary;
    $xml_pay_min=$xml_min_salary;
    $xml_pay ="";
    $xml_payment_type="Salary";
    $xml_job_type ="Perm";
    $xml_payment_rule = "";
  }
  if ($xml_job_country == "" || $xml_job_country == null || $xml_job_country == " ") {
    $xml_job_country = "none";
  }
  /*Format Numbers*/
  $xml_pay_max = round($xml_pay_max);
  $xml_pay_min = round($xml_pay_min);
  $xml_pay_max = number_format($xml_pay_max);
  $xml_pay_min = number_format($xml_pay_min);
  // if both fields are set and are a range
  $xml_payment = "$xml_currency $xml_pay_min - $xml_pay_max <span class='payment-rule'>$xml_payment_rule</span>";
  // if payment has no range
  if ($xml_pay_min == 0 && $xml_pay_max != 0) {
    $xml_payment = "$xml_currency $xml_pay_max <span class='payment-rule'>$xml_payment_rule</span>";
  }
  if ($xml_pay_max == 0 && $xml_pay_min != 0) {
    $xml_payment = "$xml_currency $xml_pay_min <span class='payment-rule'>$xml_payment_rule</span>";
  }
  if ($xml_pay_max == $xml_pay_min) {
    $xml_payment = "$xml_currency $xml_pay_max <span class='payment-rule'>$xml_payment_rule</span>";
  }
  //if payment is NEG
  if  ($xml_pay_max ==0 && $xml_pay_min ==0) {
    $xml_payment = "Negotiable";
  }
  $input = ["title" => $xml_jobtitle, "location" => $xml_job_location, "payment" => $xml_payment, "url" => $xml_jobtitle_clean_url, "country" => $xml_job_country, "jnum" => $xml_job_number];

  if ($xml_job_number == $u_job_number){
    var_dump($primary_title);
    var_dump($xml_primary_title);
    if ($primary_title == $xml_primary_title) {
      echo "true";
    } else {
      echo "false";
    }
    var_dump($xml_job_number);
    var_dump($u_job_number);
  }
  if ($primary_title == $xml_primary_title) {
    $ranking += 20;
    echo '<h1>"YES"</h1>';
  }
  if (in_array($primary_title, $xml_titles_array, true)) {
    $ranking += 10;
    echo "p in s";
  }
  if ($job_department == $xml_job_department) {
    $ranking += 1;
    echo "dep";
  }
  if ($job_country == $xml_job_country) {
    $ranking += 1;
    echo "count";
  }

  foreach($titles_array as $secondary_title) {
    if (in_array($secondary_title, $xml_titles_array, true)) {
      $ranking += 2;
      var_dump($secondary_title);
      echo "s match";
    }
  }

  add_result($ranking, $input);


} //END FOR LOOP

function result_comp($a, $b) {
  if (array_keys($a)[0] == array_keys($b)[0]) {
      return 0;
  }
  return (array_keys($a)[0] < array_keys($b)[0]) ? -1 : 1;
}
usort($results, "result_comp");
$results = array_reverse($results);
//echo $feedback;
//echo $header;
$slice = array_slice($results, 0, 5);
foreach ($slice as $sub) {
  echo array_keys($sub)[0];
  echo array_values($sub)[0];
  //var_dump($sub);
}
foreach ($results as $subr) {
  echo array_keys($subr)[0];
}
//echo $results;
?>
</div>
