<?php

// TO-DO:
//        - incorporate all other search/listing logic into this code
//        - split out code for formatting etc
//        - improve ui on results page - what was searched for, number found, header etc

/*---------------Calling Rss feed---------------*/
$force_url = "rss.xml";
$xml = simplexml_load_file($force_url);
//Count all live jobs
$number_of_jobs = count($xml->channel->item);
/*---------------Setting Local Variables---------------*/

if (isset($_GET['loc']) ) {
  $u_location = $_GET['loc'];
}
if (isset($_GET['cat']) ) {
  $u_category = $_GET['cat'];
}
if (isset($_GET['q']) ) {
  $u_keywords = $_GET['q'];
}
if (isset($_GET['jobtitle'])) {
  $u_keywords = $_GET['jobtitle'];
}
if (isset($_GET['job_location'])) {
  $u_location = $_GET['job_location'];
}
if (isset($_GET['u_jobtitle'])) {
  $u_jobtitle = $_GET['u_jobtitle'];
}
if (isset($_GET['country'])) {
  $u_country = $_GET['country'];
}
if (isset($_GET['city'])) {
  $u_city = $_GET['city'];
}
$header = "
<div id='results_column_headers' class='box-blue hidden-sm hidden-xs' >
<h4 class='col-md-6 col-lg-6 '>Job Title</h4>
<h4 class='col-md-2 col-lg-2'>Job Location</h5>
<h4 class='col-md-3 col-lg-3 '>Salary / Hourly Rate</h5>
<br><br>
</div>";
$results = "";
$dumb_keywords = ["job", "jobs"];
$result_count = 0;

function add_result($input) {
  //"title" => $jobtitle, "location" => $job_location, "payment => "$payment, "url" => $jobtitle_clean_url, "country" => $job_country, "jnum" => $job_number
  global $results, $result_count;
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
  $results .= $result;
  $result_count += 1;
}

function validate_country() {
  global $correct_result, $job_country, $u_country;

  if (strtolower($job_country) !== strtolower($u_country)) {
    $correct_result = false;
  }
}
function validate_city() {
  global $correct_result, $job_city, $u_city;

  $cities = explode(";", $job_city);
  $city_match = false;
  foreach($cities as $sf_city) {
    if ($u_city === strtolower($sf_city)) {
      $city_match = true;
    }
  }
  if ($city_match === false) {
    $correct_result = false;
  }
}
function validate_title() {
  global $correct_result, $u_jobtitle, $titles;

  $user_title = str_replace([" "], ["-"], $u_jobtitle);

  if (stripos($titles, $user_title) === false){
    $correct_result = false;
  }
}
function validate_location() {
  global $correct_result, $u_location, $u_category, $job_location;
  if (strtolower($job_location) != strtolower($u_location)) {
    $correct_result = false;
  }
}
function validate_category() {
  global $correct_result, $job_department, $u_category;

  if ($job_department != $u_category ) {
    $correct_result = false;
  }
}
function validate_keywords_and() {
  global $correct_result, $job_description, $u_keywords, $jobtitle, $dumb_keywords, $titles, $job_country, $job_city, $job_location;
  $job_info = $job_description . $jobtitle . $titles . $job_country . $job_city . $job_location;

  $u_keywords_array = explode(" ",$u_keywords);
  $keyword_match = true;
  foreach ($u_keywords_array as $keyword) {
    if (array_search(strtolower($keyword), $dumb_keywords) === false) {
      if (stripos($job_info, $keyword) === false) {
        $keyword_match = false;
      }
    }
  }
  if ($keyword_match === false) {
    $correct_result = false;
  }
}

function keyword_analytics($keywords, $industry, $location) {
  $keywords = str_replace([" ", "&", "/"], ["+", "and", ""], $keywords);
  $url = "/search-results?keywords=$keywords&industry=$industry&location=$location";
  echo "<script>ga('send', 'pageview', '$url');</script>";
}

for ($i=0; $i < $number_of_jobs ; $i++) {

  $job_department = $xml->channel->item[$i]->ts2__Department__c; //job department
  $job_location = $xml->channel->item[$i]->ts2__Location__c; //location
  $jobtitle = $xml->channel->item[$i]->title; // RSS_Job_Title__c; jobtitle
  $s_description  = $xml->channel->item[$i]->ts2__Short_Description__c; //short description
  $job_number = $xml->channel->item[$i]->ts2__Job_Number__c; //job number
  $job_description = $xml->channel->item[$i]->description;
  $job_country = $xml->channel->item[$i]->Job_Country__c; //location
  $job_city = $xml->channel->item[$i]->Job_City__c; //city
  $pub_date =$xml->channel->item[$i]->pubDate; //publish Date
  $min_pay_rate =$xml->channel->item[$i]->ts2__Min_Pay_Rate__c; //temp pay min
  $max_pay_rate  =$xml->channel->item[$i]->ts2__Max_Pay_Rate__c; //temp pay max
  $min_salary =$xml->channel->item[$i]->ts2__Min_Salary__c; //perm pay min
  $max_salary  =$xml->channel->item[$i]->ts2__Max_Salary__c; //perm pay max
  $payment_type=$xml->channel->item[$i]->RSS_Record_Type__c; //Job type: Temp or Perm
  $currency=$xml->channel->item[$i]->CCurrency__c; //Job type: Temp or Perm
  $titles=$xml->channel->item[$i]->Job_Titles__c; //Job type: Temp or Perm

  $jobtitle_clean_url = str_replace([" ", "&", "/"], ["-", "and", ""], $jobtitle);
  $jobtitle_clean_url = preg_replace("/\xE2\x80\x8B/", "", $jobtitle_clean_url);

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
    $payment_type="Salary";
    $job_type ="Perm";
    $payment_rule = "";
  }
  if ($job_country == "" || $job_country == null || $job_country == " ") {
    $job_country = "none";
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
  $input = ["title" => $jobtitle, "location" => $job_location, "payment" => $payment, "url" => $jobtitle_clean_url, "country" => $job_country, "jnum" => $job_number];

  $correct_result = true;

  /*---------------Country---------------*/
  if (isset($u_country) && $u_country !== ""){
    validate_country();
  }
  /*---------------City---------------*/
  if (isset($u_city) && $u_city !== ""){
    validate_city();
  }
  /*---------------Title---------------*/
  if(isset($u_jobtitle) && $u_jobtitle !== ""){
    validate_title();
  }
  /*---------------Category---------------*/
  if (isset($u_category) && $u_category !== "Industry" && $u_category !== "") {
    validate_category();
  }
  /*---------------Location---------------*/
  if (isset($u_location) && $u_location !== "Location" && $u_location !== "") {
    validate_location();
  }
  /*---------------keywords---------------*/
  if (isset($u_keywords) && $u_keywords !== "") {
    validate_keywords_and();
  }
  /*---------------Display Result---------------*/
  if ($correct_result == true) {
    add_result($input);
  }

} //END FOR LOOP

$feedback = "<h3>Your search returned $result_count results</h3>";

if ($results == "") {
  echo "<div class='container-fluid'>
  <h3 class='text-center'>There are currently no jobs available for the industry/location selected.</h3>
  <br>
  <h3 class='text-center'>Click one of the links below to see current jobs in a specific industry.</h3>
  <br>
  <div class='col-md-12 col-lg-12 col-sm-12 col-xs-12 no-search-results'>
  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
  <a class='btn btn-primary full-width' href='biotech-pharma-medical-device-jobs'>Biotech - Pharma - Medical Device Jobs</a>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
  <a class='btn btn-primary full-width' href='engineering-design-jobs'>Engineering & Design Jobs</a>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
  <a class='btn btn-primary full-width' href='construction-infrastructure-jobs'>Construction & Infrastructure Jobs</a>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
  <a class='btn btn-primary full-width' href='manufacturing-food-beverage-jobs'>Manufacturing Jobs</a>
  </div>
  </div>
  </div>";
} else {
  echo $feedback;
  echo $header;
  echo $results;
}
/*---------------Google Analytics for Site Search---------------*/

if (isset($_POST['search_location']) || isset($_POST['search_category']) || isset($_POST['search_bar'])) {
  keyword_analytics($u_keywords, $u_category, $u_location);
}
/*
if ($display_count != 1) {
echo "$display_count jobs";
}else echo"$display_count job";
*/
?>
</div>
