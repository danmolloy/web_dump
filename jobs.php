<!--Job title Page-->
<?php 
// Testing Variables 
require "db_connect.php";
if ( isset($_GET['u_jobtitle']) ) {

	$u_jobtitle = $_GET['u_jobtitle'];
	$h1 = $u_jobtitle;
	$h1 = str_replace("-", " ", $h1);
	$h1 = ucwords($h1);
	$query = "SELECT ";
//	$query .= "DISTINCT salesforce ";
	$query .= "* ";
	$query .= "FROM csv_preset ";
	$query .= "WHERE salesforce = '$u_jobtitle';";
	$result = mysqli_query($db_conx, $query);

	//Test for query error
	if (!$result) {
		die("db query failed");
	}
	
	while ($row = mysqli_fetch_assoc($result)) {
		$page_title =  $row["page_title"];
		$meta_description =  $row["meta_description"];
		$meta_keywords =  $row["meta_keywords"];
		$image =  $row["image"];
		$paragraph =  $row["paragraph"];
		$paragraph2 =  $row["paragraph2"];
		$paragraph3 =  $row["paragraph3"];
		$paragraph4 =  $row["paragraph4"];
		$paragraph5 =  $row["paragraph5"];
		$paragraph6 =  $row["paragraph6"];
		$paragraph7 =  $row["paragraph7"];
		$paragraph8 =  $row["paragraph8"];
		$paragraph9 =  $row["paragraph9"];
		$paragraph10 =  $row["paragraph10"];
		//var_dump($row);
	}
}


	include"job_title_header.php";
	include"top.php";
	include"nav2.php";		
?>
<div class="wrapper centered">
	<div class="container-fluid">
		<?php include "search_bar.php" ?>
		<?php include"job_content_area.php"; ?>
	</div>
</div>
<?php include"footer.php"; ?>