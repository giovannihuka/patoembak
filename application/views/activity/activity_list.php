<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container">

      <!-- <div class="w3-card-2"> -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title" style="font-weight: bold;">Kegiatan GBI Patoembak</h3>
        </div>
      </div>
    <!-- </div> -->

<?php if (count($schedule_list)>0) { ?>
      <?php
        $i=1;
        foreach ($schedule_list as $row) {
         if ($row['today_date'] === date('d')) {
          echo '
              <div class="w3-row w3-light-grey w3-card-4 w3-round-medium">
                <div class="w3-col s3 w3-center" style="margin-bottom: 15px;">
                  <h3 style="font-weight: bold; margin: 15px 0px 0px 0px;">'.$row['ddt'].'</h3>
                  <h3 style="font-weight: bold; margin: 0px 0px 5px 0px;">'.$row['mot'].'</h3>
                  <h7>'.$row['jam_mulai'].'-'.$row['jam_selesai'].'</h7>
                </div>
                <div class="w3-col s9 w3-container">
                  <h5 style="font-weight: bold;">'.$row['activity_name'].'</h5>
                  <p style="font-size: larger;">'.$row['remarks'].'</p>
                </div>
              </div>  
              <hr>
          ';
        } else {
          echo '
              <div class="w3-row">
                <div class="w3-col s3 w3-center" >
                  <h3 style="font-weight: bold; margin: 15px 0px 0px 0px;">'.$row['ddt'].'</h3>
                  <h3 style="font-weight: bold; margin: 0px 0px 5px 0px;">'.$row['mot'].'</h3>
                  <h7>'.$row['jam_mulai'].'-'.$row['jam_selesai'].'</h7>
                </div>
                <div class="w3-col s9 w3-container">
                  <h5 style="font-weight: bold;">'.$row['activity_name'].'</h5>
                  <p style="font-size: larger;">'.$row['remarks'].'</p>
                </div>
              </div>  
              <hr>
          ';
        }
   } ?>
<?php } ?>

</div>