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
      <form name="search_jobs" action="search-results" method="post">
        <h2>Search Jobs</h2>
        <input name="search_bar" type="text" placeholder="Enter Keywords " class="apply-input flat-corners col-lg-4 col-md-4 col-sm-12 col-xs-12 search-bar-input">
          <select name="search_category" class=" apply-input search-bar-input flat-corners col-lg-3 col-md-3 col-sm-12  col-xs-12">
            <option>Industry</option>
            <option value="Engineering-Design-Jobs">Engineering Design</option>
            <option value="Construction-Infrastructure-Jobs">Construction Infrastructure</option>
            <option value="Biotech-Pharma-Medical-Device-Jobs">Biotech Pharma Medical Device</option>
            <option value="Manufacturing-Food-Beverage-Jobs">Manufacturing Food Beverage</option>
          </select>
          <select name="search_location" class="apply-input search-bar-input flat-corners col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <option>Location</option>
            <option>Africa</option>
            <option>Asia</option>
            <option>Australia-New-Zealand</option>
            <option>Canada</option>
            <option>China</option>
            <option>Europe</option>
            <option>India</option>
            <option>Ireland</option>
            <option>Middle-East</option>
            <option>UK</option>
           <!-- <option>Worldwide</option>-->
          </select>
          <input type="hidden" name="posted" value="true">
          <input class="btn col-lg-1 col-md-1 col-sm-12 col-xs-12 btn-warning apply-input flat-corners" type="submit" value="Search">
        
      </form>
  </div>

   



</div><!--END Row-->
