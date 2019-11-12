
<!-- <div class="container" style="margin: 0px 5px 3px 5px;"> -->
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container"">

<?php if ((count($scripture)>0) && (!$this->ion_auth->logged_in())) { ?>

<div class="w3-panel w3-card w3-round-large w3-light-grey">
  <p class="w3-large w3-serif">
    <i class="fa fa-quote-right w3-large w3-text-red"></i><br>
    <i><?php echo $scripture['scriptures_text'] ?></i>
  </p>
  <?php if (!empty($scripture['scripture_section'])) { ?>
    <p><?php echo $scripture['scripture_section'] ?></p>
  <?php } ?>
</div>
<?php } ?>


<?php if (!$this->ion_auth->logged_in()) { ?>
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
<?php } ?>


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

<!-- <?php if (count($schedule_list)>0) { ?>
      <?php
        $i=1;
        foreach ($schedule_list as $row) {
          if ($row['today_date'] === date('d')) {
          echo '
            <div class="w3-panel w3-card-4" style="padding:0px">
              <div class="w3-col m12">
                  <div class="w3-col s2">
                      <div class="w3-col s12 w3-indigo" style="height:100px;">
                        <h2 class="box-title" style="font-weight: bold; margin-bottom: 0px; margin-top: 20px; text-align: center;">'.$row['ddt'].'</h2>
                        <h5 class="box-title" style="font-weight: bold; margin-top: 0px; text-align: center;">'.$row['mot'].'</h5>
                      </div>
                    </div>
                  <div class="w3-col s10">
                      <div class="w3-col s12 w3-indigo" style="height:40px;">
                        <h5 class="box-title" style="font-weight:bold; margin-top: 5px; text-align: center;">'.$row['activity_name'].'
                        </h5>
                      </div>
                      <div class="w3-col s8 w3-light-grey"  style="height:60px; text-align: left; padding-left: 5px;">'.$row['remarks'].'</div>
                      <div class="w3-col s4 w3-light-grey"  style="height:60px; text-align: right; padding-right: 5px;">'.$row['jam_mulai'].'-'.$row['jam_selesai'].'</div>
                    </div>
              </div>
            </div>
          ';

        } elseif ($row['today_date'] < date('d')) {
          echo '

            <div class="w3-panel" style="padding:0px">
              <div class="w3-col m12 w3-gray">
                <div class="w3-col s3">
                    <h5 class="box-title" style="text-align: center;">'.$row['ddt'].' '.$row['mot'].'</h5>
                </div> 
                <div class="w3-col s5">
                    <h5 class="box-title">'.$row['activity_name'].'</h5>
                </div>
                <div class="w3-col s4">
                    <h5 class="box-title" style="text-align: right; padding-right: 5px;">'.$row['jam_mulai'].'-'.$row['jam_selesai'].'</h5>
                </div>
              </div>
            </div>

          ';  
        } else {
          echo '
            <div class="w3-panel w3-card-4" style="padding:0px">
              <div class="w3-col m12">
                  <div class="w3-col s2">
                      <div class="w3-col s12 w3-gray" style="height:100px;">
                        <h2 class="box-title" style="font-weight: bold; margin-bottom: 0px; margin-top: 20px; text-align: center;">'.$row['ddt'].'</h2>
                        <h5 class="box-title" style="font-weight: bold; margin-top: 0px; text-align: center;">'.$row['mot'].'</h5>
                      </div>
                    </div>
                  <div class="w3-col s10">
                      <div class="w3-col s12 w3-light-grey" style="height:40px;">
                        <h5 class="box-title" style="font-weight:bold; margin-top: 5px; text-align: center;">'.$row['activity_name'].'
                        </h5>
                      </div>
                      <div class="w3-col s8 w3-white"  style="height:60px; text-align: left; padding-left: 5px;">'.$row['remarks'].'</div>
                      <div class="w3-col s4 w3-white"  style="height:60px; text-align: right; padding-right: 5px;">'.$row['jam_mulai'].'-'.$row['jam_selesai'].'</div>
                    </div>
              </div>
            </div>
          ';          
        }
        $i++;
      }
    ?>
<?php } ?> -->


    <div class="w3-card-2">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title" style="font-weight: bold;">Kegiatan Minggu Ini</h3>
        </div>
      </div>
    </div>

<!-- Put Caorousel here -->
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

          ';
        }
   } ?>
<?php } ?>

<!-- </div> -->
<!-- END OF CAROUSEL -->

</div>