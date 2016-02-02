 <!--Industry-->
<?php require "db_connect.php";
// Testing Variables

if ( isset($_GET['industry']) ) {

	$industry = $_GET['industry'];
	$u_category = $industry;

	$h1 = "Jobs in " . $industry;
	$query = "SELECT ";
//	$query .= "DISTINCT salesforce ";
	$query .= "* ";
	$query .= "FROM industry ";
	$query .= "WHERE salesforce = '$industry';";
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



?>
 <?php
 require "db_connect.php";
 include"featured_locations.php";

$custom_header = '

';
include"header.php";

include"top.php";
include"nav2.php";
		?>
		<div class="wrapper centered">
		<div class="container-fluid">
 		<?php
			include "search_bar.php";
			//include "top_bar.php";
		?>
			<?php
			//include "sidebar.php";
			include"job-content.php";
			?>
		<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	</div>
</div>
<?php include"footer.php";?>
