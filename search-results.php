
<?php
require "db_connect.php"; 
require "functions.php";
include "header.php";

 
include"top.php";
include"nav2.php";
	?>
<div class="wrapper centered">
	<div class="container-fluid">
	<?php
	include"search_bar.php";
		?>
		<div class="row">
			<?php // include "sidebar.php"; ?>
			 <div class="col-md-12 box font-lato" id="first_col"> <!--col-md-offset-3 -->
			<?php include"jobsearch_result4.php";?>
			</div>
		</div>
	</div>
</div>

	<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	</div>
</div>
<?php
include"footer.php";
?>



