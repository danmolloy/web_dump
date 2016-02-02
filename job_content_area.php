<div class="row">
	<div class="box col-md-12">
		<h1 id="job_header"><?php echo $h1 ?></h1>
			<p id="page_text">
			<?php
				if (isset($paragraph) && $paragraph !="" && $paragraph != null ) {
					$text = $paragraph;
				}else {echo "Jobcontax specialises in $jobtitle jobs globaly, find and search $jobtitle jobs in" ;}
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
		<?php include 'jobsearch_result4.php' ?>
	</div>
</div>
