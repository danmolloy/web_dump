<?php require "db_connect.php"; 
// Testing Variables 

if ( isset($_GET['city']) ) {

	$city = $_GET['city'];
	$query = "SELECT ";
//	$query .= "DISTINCT salesforce ";
	$query .= "* ";
	$query .= "FROM city ";
	$query .= "WHERE salesforce = '$city';";
	$result = mysqli_query($db_conx, $query);
	#$city = str_replace("-", " ", $city);
	#$h1 = "Jobs in " . ucwords($city);

	//Test for query error
	if (!$result) {
		die("db query failed");
	}
	
	while ($row = mysqli_fetch_assoc($result)) {
		$page_title =  $row["page_title"];
		$meta_description =  $row["meta_description"];
		$meta_keywords =  $row["meta_keywords"];
		$image =  $row["image"];
		$h1 = "Jobs in " . $row["salesforce"];
		$h1 = str_replace("-", " ", $h1);
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



?>

<!--Job Location Page-->
<?php 
	include"header.php";
	include"top.php";
	include"nav2.php";	
?>
<div class="wrapper centered">
	<div class="container-fluid">	
		
		<!--Content-->
		

<div class="row">
	<div class="container-fluid">
		<?php include "search_bar.php"; ?>
	</div>
	<div class="box col-md-12">
		<h1 class="hidden-md hidden-lg"><?php if (!isset($h1)) {
				echo"Header";
			}else echo"$h1"; ?> </h1>
		
		
			<h1 id="top_header_small" class="hidden-sm hidden-xs"><?php if (!isset($h1)) {
				echo"Header";
			}else echo"$h1"; ?> </h1> <hr />
			<p id="page_text"> 
			<?php
				if (isset($paragraph) && $paragraph !="" && $paragraph != null ) {
					$text = $paragraph;
				}else {echo "Jobcontax specialises in $jobtitle jobs globally, find and search $jobtitle jobs in" ;}
				if (isset($paragraph2) && $paragraph2 !="" && $paragraph2 != null ) {
					$text = $text . "<br /> <br />" . $paragraph2;
				}
				if (isset($paragraph3) && $paragraph3 !="" && $paragraph3 != null ) {
					$text = $text . "<br /> <br />" . $paragraph3;
				}
				if (isset($paragraph4) && $paragraph4 !="" && $paragraph4 != null ) {
					$text = $text . "<br /> <br />" . $paragraph4;
				}
				if (isset($paragraph5) && $paragraph5 !="" && $paragraph5 != null ) {
					$text = $text . "<br /> <br />" . $paragraph5;
				}
				if (isset($paragraph6) && $paragraph6 !="" && $paragraph6 != null ) {
					$text = $text . "<br /> <br />" . $paragraph6;
				}
				if (isset($paragraph7) && $paragraph7 !="" && $paragraph7 != null ) {
					$text = $text . "<br /> <br />" . $paragraph7;
				}
				if (isset($paragraph8) && $paragraph8 !="" && $paragraph8 != null ) {
					$text = $text . "<br /> <br />" . $paragraph8;
				}
				if (isset($paragraph9) && $paragraph9 !="" && $paragraph9 != null ) {
					$text = $text . "<br /> <br />" . $paragraph9;
				}
				if (isset($paragraph10) && $paragraph10 !="" && $paragraph10 != null ) {
					$text = $text . "<br /> <br />" . $paragraph10;
				}
				if (isset($text)) {
					echo $text;
				}
			 ?>
			</p>
	</div>
	</div>
	<div class="row">
		<div class="box">
			<?php include 'jobsearch_result4.php'; ?>
		</div>
	</div>
	

		<!--End Content-->


	</div>
</div>
<?php include"footer.php"; ?>