
<!-- <div class="container" style="margin: 0px 5px 3px 5px;"> -->
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container"">

<?php if ((count($scripture)>0) && (!$this->ion_auth->logged_in())) { ?>

<div class="w3-panel w3-card w3-round-large w3-light-grey">
  <p class="w3-large w3-serif">
    <i class="fa fa-quote-left w3-large w3-text-red"></i><br>
    <i><?php echo $scripture['scriptures_text'] ?></i>
  </p>
  <?php if (!empty($scripture['scripture_section'])) { ?>
    <p><?php echo $scripture['scripture_section'] ?></p>
  <?php } ?>
</div>
<?php } ?>


<!-- <?php if (!$this->ion_auth->logged_in()) { ?> -->
  <?php if (count($today_bday)>0) { ?>
    <div class="w3-card-4 w3-round-large">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title" style="font-weight: bold;">Ulang Tahun Hari Ini</h3>
        </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-striped wrap" style="font-size: larger;">
                <tr>
                  <th style="width: 3%; text-align: center;">#</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Hari</th>
                  <th style="text-align: center;">Tanggal</th>
                </tr>
          <?php
            $i=1;
            foreach ($today_bday as $row) {
                echo '
                  <tr style="background-color:#337ab7 !important; color: #fff;">
                    <td style="text-align: center; width: 5%;">'.$i.'.</td>
                    <td style="text-align: left; width: 25%;">'.$row['full_name'].' ('.$row['umur'].') </td>
                    <td style="text-align: center; width: 20%;">'.$row['day_name'].'</td>
                    <td style="text-align: center; width: 20%;">'.$row['tgl_ulangtahun'].'</td>
                    <!-- <td style="text-align: center; width: 30%;">Selamat ulang tahun...</td> -->
                  ';
              $i++;
            } 
          ?>
              </table>
            </div>  
      </div>
    </div>
  <?php } ?>
<!-- <?php } ?> -->


<?php if ($this->ion_auth->logged_in()): ?>
  <?php if ($this->ion_auth->in_group(array('internal'))) { ?>

<?php if (count($bday_list)>0) { ?>
  <div class="w3-card-4 w3-round-large">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title" style="font-weight: bold;">Ulang Tahun Bulan Ini</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-striped wrap" style="font-size: larger;">
          <tr>
            <th style="width: 3%; text-align: center;">#</th>
            <th style="text-align: center;">Nama</th>
            <th style="text-align: center;">Hari</th>
            <th style="text-align: center;">Tanggal</th>
          </tr>
          <?php
            $i=1;
            foreach ($bday_list as $row) {
              if ($row['tgl_ulangtahun'] === date('d')) {
                echo '
                  <tr style="background-color:#337ab7 !important; color: #fff; font-weight: bold;">
                    <td style="text-align: center; width: 5%;">'.$i.'.</td>
                    <td style="text-align: left; width: 25%;">'.$row['full_name'].' ('.$row['umur'].') </td>
                    <td style="text-align: center; width: 20%;">'.$row['day_name'].'</td>
                    <td style="text-align: center; width: 20%;">'.$row['tgl_ulangtahun'].'</td>
                    <!-- <td style="text-align: center; width: 30%;">Selamat ulang tahun...</td> -->
                  ';
              } else {
                echo '
                  <tr>
                    <td style="text-align: center; width: 5%;">'.$i.'.</td>
                    <td style="text-align: left; width: 25%;">'.$row['full_name'].' ('.$row['umur'].') </td>
                     <td style="text-align: center; width: 20%;">'.$row['day_name'].'</td>
                    <td style="text-align: center; width: 20%;">'.$row['tgl_ulangtahun'].'</td>
                    <!-- <td style="text-align: center; width: 30%;"></td>  -->
                  ';
              }
              $i++;
            } 
          ?>
        </table>
      </div>
    </div>
  </div>
<?php } ?>

  <?php } ?>
<?php endif; ?>


<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title" style="font-weight: bold;">Kegiatan Minggu Ini</h3>
  </div>
</div>

<!-- Put Caorousel here -->
<?php if (count($schedule_list)>0) { ?>
      <?php
        $i=1;
        foreach ($schedule_list as $row) {
         if ($row['today_date'] === date('d m Y')) {
          echo '
              <div class="w3-row w3-light-grey w3-card-4 w3-round-medium">
                <div class="w3-col s3 w3-center" style="margin-bottom: 15px;">
                  <h3 style="font-weight: bold; margin: 15px 0px 0px 0px;">'.$row['ddt'].'</h3>
                  <h3 style="font-weight: bold; margin: 0px 0px 5px 0px;">'.$row['mot'].'</h3>
                  <h7>'.$row['jam_mulai'].'-'.$row['jam_selesai'].'</h7>
                </div>
                <div class="w3-col s9 w3-container">
                  <h5 style="font-weight: bold;">'.$row['activity_name'].'</h5>'
                  .$row['remarks'].
                '</div>
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
                  <h5 style="font-weight: bold;">'.$row['activity_name'].'</h5>'
                  .$row['remarks'].
                '</div>
              </div>  
              <hr>
          ';
        }
   } ?>
<?php } ?>

<!-- </div> -->
<!-- END OF CAROUSEL -->

</div>