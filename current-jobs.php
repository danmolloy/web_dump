<?php 
$meta_description = "Jobs in Construction & Infrastructure, Engineering & Design, Biotechnology & Pharmaceutical, Medical Device & Manufacturing sectors.";
$meta_keywords = "Biotech jobs,Pharma jobs,Medical Device Jobs, Construction jobs, Infrastructure Jobs, Engineering jobs, Design Jobs,Manufacturing Jobs ";
$page_title = "JobContax Current Jobs | Engineer Jobs";
require "db_connect.php"; 


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
			include"current_content.php";
			?> 
		<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	</div>
</div>
<?php include"footer.php";?> 

