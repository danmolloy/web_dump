<?php
/*
require "db_connect.php";

      $force_url = "http://jobcontax.force.com/careers/ts2__apply_to_job?nostate=1&tSource=a0eo0000000XcTNAA0&f=a1Ho0000000MKkvEAG&showJobs=300";
      $xml = simplexml_load_file($force_url);
      $jobtitle ="";
      */
?>

<!--Search bar-->

<div id="search_bar" class="row box-search-bar">
  <div class="font-lato search-form">
      <form name="search_jobs" action="search-results" method="get">
        <h2>Search Jobs</h2>
        <?php if (isset($_GET['q']) && $_GET['q'] !== ""){
          $placeholder =  "value='".$_GET['q']."'";
        }else{
          $placeholder = "placeholder=\"Enter Keywords\"";
        }?>
        <input name="q" type="text" <?php echo " $placeholder " ?> class="apply-input flat-corners col-lg-4 col-md-4 col-sm-12 col-xs-12 search-bar-input">
          <select name="cat" class=" apply-input search-bar-input flat-corners col-lg-3 col-md-3 col-sm-12  col-xs-12">
            <option>Industry</option>
            <option value="Engineering-Design-Jobs" <?php if ($_GET['cat'] === "Engineering-Design-Jobs") {echo "selected";} ?> >Engineering Design</option>
            <option value="Construction-Infrastructure-Jobs" <?php if ($_GET['cat'] === "Construction-Infrastructure-Jobs"){echo "selected";} ?>>Construction Infrastructure</option>
            <option value="Biotech-Pharma-Medical-Device-Jobs" <?php if ($_GET['cat'] === "Biotech-Pharma-Medical-Device-Jobs"){echo "selected";} ?>>Biotech Pharma Medical Device</option>
            <option value="Manufacturing-Food-Beverage-Jobs" <?php if ($_GET['cat'] === "Manufacturing-Food-Beverage-Jobs"){echo "selected";} ?>>Manufacturing Food Beverage</option>
          </select>
          <select name="loc" class="apply-input search-bar-input flat-corners col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <option>Location</option>
            <option <?php if ($_GET['loc'] === "Africa") {echo "selected";} ?>>Africa</option>
            <option <?php if ($_GET['loc'] === "Asia") {echo "selected";} ?>>Asia</option>
            <option <?php if ($_GET['loc'] === "Australia-New-Zealand") {echo "selected";} ?>>Australia-New-Zealand</option>
            <option <?php if ($_GET['loc'] === "Canada") {echo "selected";} ?>>Canada</option>
            <option <?php if ($_GET['loc'] === "China") {echo "selected";} ?>>China</option>
            <option <?php if ($_GET['loc'] === "Europe") {echo "selected";} ?>>Europe</option>
            <option <?php if ($_GET['loc'] === "India") {echo "selected";} ?>>India</option>
            <option <?php if ($_GET['loc'] === "Ireland") {echo "selected";} ?>>Ireland</option>
            <option <?php if ($_GET['loc'] === "Middle-East") {echo "selected";} ?>>Middle-East</option>
            <option <?php if ($_GET['loc'] === "UK") {echo "selected";} ?>>UK</option>
           <!-- <option>Worldwide</option>-->
          </select>
          <input class="btn col-lg-1 col-md-1 col-sm-12 col-xs-12 btn-warning apply-input flat-corners" type="submit" value="Search">

      </form>
  </div>





</div><!--END Row-->
