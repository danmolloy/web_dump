<?php

if (isset($_GET['job_number'])) {
	$u_job_number = $_GET['job_number'];

}
$pay_min =0;
$pay_max =0;
$jobfound = 0;

/*---------------Calling Rss feed---------------*/
$force_url = "rss.xml";
$xml = simplexml_load_file($force_url);
//Count all live jobs jobs
$number_of_jobs = count($xml->channel->item);
$all_jobs = array($xml->channel) ;



/*---------------Looping through all jobs---------------*/
for ($i=0; $i < $number_of_jobs ; $i++) {
	$rss_job_department = $xml->channel->item[$i]->ts2__Department__c; //job department
	$rss_job_location = $xml->channel->item[$i]->ts2__Location__c; //location

	$rss_jobtitle = $xml->channel->item[$i]->title; //jobtitle
	$rss_s_description  = $xml->channel->item[$i]->ts2__Short_Description__c; //short description
	$rss_job_number = $xml->channel->item[$i]->ts2__Job_Number__c; //job number

	$rss_job_country = $xml->channel->item[$i]->Job_Country__c; //country
	$rss_job_city = $xml->channel->item[$i]->Job_City__c; //city
	$rss_pub_date =$xml->channel->item[$i]->pubDate; //publish Date
	$rss_job_description =$xml->channel->item[$i]->description; //description
	$rss_job_type = $xml->channel->item[$i]->RSS_Record_Type__c; //job type
	$rss_min_pay_rate =$xml->channel->item[$i]->ts2__Min_Pay_Rate__c; //min pay rate
	$rss_max_pay_rate =$xml->channel->item[$i]->ts2__Max_Pay_Rate__c; //max pay rate

	$rss_min_salery =$xml->channel->item[$i]->ts2__Min_Salary__c; //min salery
	$rss_max_salery =$xml->channel->item[$i]->ts2__Max_Salary__c; //max salery
	$rss_owner =$xml->channel->item[$i]->Owner__c; //owner
	$rss_titles=$xml->channel->item[$i]->Job_Titles__c;
	$rss_primary_title=$xml->channel->item[$i]->Primary_Job_Skill__c;

	/*---------------Creating Local Variables For Set Job number---------------*/
	if (isset($u_job_number)) {
		if ($rss_job_number == $u_job_number) {
			$u_jobtitle = $rss_jobtitle;
			$job_department = $rss_job_department;
			$job_location = $rss_job_location;

			$job_country = $rss_job_country;
			$job_city = $rss_job_city;
			$pub_date = $rss_pub_date;
			$description = $rss_job_description;
			$job_type = $rss_job_type;
			$owner = $rss_owner;
			$titles = $rss_titles;
			$primary_title = $rss_primary_title;
			$titles_array = explode(";", $titles);


			$min_pay_rate = round($rss_min_pay_rate);
			$max_pay_rate = round($rss_max_pay_rate);
			$min_salary = round($rss_min_salery);
			$max_salary = round($rss_max_salery);
			$payment_type=$xml->channel->item[$i]->RSS_Record_Type__c; //Job type: Temp or Perm
			$currency=$xml->channel->item[$i]->CCurrency__c; //Job type: Temp or Perm
			$jobfound = 1;
		}
	}
}//END Loop through all job
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


?>


<?php
require "db_connect.php";

//$custom_header = '<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
//<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>'

;
$meta_keywords="$u_jobtitle, $job_department, $job_country, $job_city, $job_location ";
$meta_description="Apply for $u_jobtitle in $job_country $job_location ";
$page_title="Jobcontax $u_jobtitle | $job_country | $u_job_number";

?>

<!--LinkedIn API Call-->



<?php
include"header.php";
include"top.php";
include"nav2.php";
?>
<div class="wrapper centered">
	<div class="container-fluid">
		<?php
		//	include "search_bar.php";
		?>
		<?php
		include"job_details_content.php";
		?>
		<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	</div>
</div>
<?php include"footer.php";?>
