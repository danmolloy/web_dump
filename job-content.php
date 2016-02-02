<div class="row">
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 box"> <!--col-md-offset-3 -->

		<?php if (isset($_GET['industry'])) {
			$h1 = $_GET['industry'];
			$h1 = str_replace("-", " ", $h1);
		} ?>
		<h1 id="industry_header"><?php echo $h1; ?> </h1> <hr />
		<p id="page_text"><?php echo $paragraph; ?></p>

		<!--<p>JobContax Recruitment Agency is a specialist within the Construction &amp; Infrastructure, Engineering &amp; Design, Mining - Oil &amp; Gas and Biotechnology - Pharmaceutical sectors. During the past 10 years, JobContax has developed an extensive network worldwide contacts and has long standing partnerships with the world's largest EPCm Contractors. Sign up for our Jobs Alerts by E-Mail or our RSS Job Feed to get real time job updates.</p>-->

	</div>
	<?php include"jobsearch_result4.php"; ?>
</div>
