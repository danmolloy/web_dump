<?php
$page_title = "Amgen Jobs | Amgen Jobs Dublin | Amgen Jobs Ireland | Amgen Ireland";
$meta_description = "JobContax - Search and Apply for Amgen Jobs in Dublin - Ireland. Visit www.jobcontax.com to apply for Amgen Jobs in Ireland.";
$meta_keywords = "Amgen Jobs, Amgen Jobs Dublin, Amgen Jobs Ireland, Amgen Ireland,amgen,amgen dublin,amgen europe";
/*---------------Edit this line---------------*/
$u_keywords ="amgen";

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
			<div class="row">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 box"> <!--col-md-offset-3 -->
					<h1 class="header-box">Amgen Jobs - Dublin, Ireland</h1> <hr />
					<p>JobContax is a preferred supplier to Amgen. All Amgen jobs are based in their Dun Laoighaire plant in Dublin. The plant is one of the most dynamic in Ireland and is currently undergoing rapid expansion and capital investment. Typical Amgen jobs are Validation, QA-QC, Process, Packaging, Project Managers, Automation, BMS, Technical Writing, CQV, HVAC, HSE</p>
				</div>
			</div>
			<?php  /*---------------DO NOT EDIT ANYTHING BELOW THIS LINE---------------*/?>
			<div class="row">
				<?php // include "sidebar.php"; ?>
				 <div class="col-md-12 box font-lato" id="first_col"> <!--col-md-offset-3 -->
				<?php include"jobsearch_result4.php";?>
			</div>

	</div>
</div>
<?php include"footer.php";?>
