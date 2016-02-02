
<div class='row'>
	<div class="box2 font-lato">
		<?php if ($jobfound == 1): ?>
			<?php echo "<h2 class='header-box'>" . $u_jobtitle . "</h2> <hr />" ?>
			<div class="col-md-12 font-lato">
				<div class="col-md-4">
					<p class="">Location: <?php echo  $job_country; ?> </p>
				</div>

				<div class="col-md-4 font-lato">
					<?php echo "$payment" ?></p>
				</div>

				<div class="col-md-4 font-lato">
					<p class="">Job Type: <?php echo $job_type; ?></p>
				</div>
			</div>

			<div class="col-md-12 font-lato">
				<div class="col-md-4">
					<p class="">Industry: <?php echo "$job_department"; ?> </p>
				</div>

				<div class="col-md-4 font-lato">
					<p class="">Job ID: <?php echo $u_job_number; ?> </p>
				</div>

				<div class="col-md-4 font-lato">
					<p class="">Consultant: <?php if (isset($owner) && $owner != ""){ echo $owner;} ?></p>
				</div>
			</div>
			<br /><br />

		</div>

		<div class="box font-lato col-md-12 ">

			<!--<a href="linkedin4.php" class="col-md-3 apply-input col-xs-12 btn btn-warning flat-corners ">Apply With Linkedin</a> -->

			<div class="col-sm-12 col-xs-12 hidden-lg hidden-md">  <p> </p></div>
			<?php $current_url= $_SERVER['REQUEST_URI'] ?>
			<a class="col-md-3 col-xs-12 apply-input btn btn-warning flat-corners " href='<?php echo $current_url ?>#application_form'>Apply With CV</a>

			<br /> <br /><br />
			<div class="font-lato">
				<div class="col-sm-12 col-xs-12 hidden-lg hidden-md"> <p> <br /><br /></p><p> </p></div>
				<?php echo $description; ?>
			</div>
			<div class="centered">
			</div>
			<br />
		</div>
		<div class="box col-md-12 ">
			<a name="application_form"></a>
			<?php include"application_form.php"; ?>
		</div>




		<!-- Application Form


		<div class="col-md-9 col-md-offset-3 box-blue" id="application-form" >
		<div class="box font-lato">
		<?php// include"application_form.php"; ?>
	</div>
</div>

-->

<?php

if (isset($owner) && $owner != "") {
	include"recruiter_profile.php";
}
endif ?>

<div class="col-md-12 box font-lato">
	<h2>Similar Jobs</h2>
	<?php include"similar_jobs.php";?>
</div>


<?php if ($jobfound == 0) {
	echo('<h1>Job No longer available </h1>
	<div class="box font-lato">
	<p>This Job is no longer live on our website</p>
	<p>Job ID: '. $u_job_number .'</p>
	</div>
	');
} ?>

</div>
