
<!-- <div class="container" style="margin: 0px 5px 3px 5px;"> -->
<!-- <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> -->
<div class="container"">

<!-- <div class="w3-card-4 w3-round-large">
  <div class="jumbotron" style="background: transparent !important;">
    <p align="center" style="font-weight: bold;">
      <?php echo $scripture ?>
    </p>
  </div>
</div> -->

<?php if (count($scripture)>0) { ?>
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

<!-- <?php if (count($schedule_list)>0) { ?>
  <div class="w3-card-4 w3-round-large">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title" style="font-weight: bold;">Kegiatan Minggu Ini</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-striped" style="font-size: larger;">
          <tr>
            <th style="text-align: center; width: 5%;">#</th>
            <th style="text-align: center; width: 25%;">Nama Kegiatan</th>
            <th style="text-align: center; width: 10%;">Hari</th>
            <th style="text-align: center; width: 20%;">Tgl. Kegiatan</th>
            <th style="text-align: center; width: 10%;">Waktu Mulai</th>
            <th style="text-align: center; width: 30%;">Pelayan/Sharing Firman</th>
          </tr>
          <?php
            $i=1;
            foreach ($schedule_list as $row) {
              if ($row['today_date'] === date('d')) {
                echo '
                  <tr style="background-color:#337ab7 !important; color: #fff; font-weight: bold;">
                    <td style="text-align: center; width: 5%;">'.$i.'.</td>
                    <td style="text-align: left; width: 25%;">'.$row['activity_name'].'</td>
                    <td style="text-align: left; width: 10%;">'.$row['day_name'].'</td>
                    <td style="text-align: center; width: 20%;">'.$row['tgl'].'</td>
                    <td style="text-align: center; width: 10%;">'.$row['jam_mulai'].'</td>
                    <td style="text-align: left; width: 30%;">'.$row['remarks'].'</td>
                ';
              } else {
                echo '
                  <tr>
                    <td style="text-align: center; width: 5%;">'.$i.'.</td>
                    <td style="text-align: left; width: 25%;">'.$row['activity_name'].'</td>
                    <td style="text-align: left; width: 10%;">'.$row['day_name'].'</td>
                    <td style="text-align: center; width: 20%;">'.$row['tgl'].'</td>
                    <td style="text-align: center; width: 10%;">'.$row['jam_mulai'].'</td>
                    <td style="text-align: left; width: 30%;">'.$row['remarks'].'</td>
                ';              
              }
            $i++;
          }
          ?>
        </table>
      </div>
    </div>
  </div>
<?php } ?> -->



<?php if (count($schedule_list)>0) { ?>
  <div class="w3-card-4 w3-round-large">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title" style="font-weight: bold;">Kegiatan Minggu Ini</h3>
      </div>
      <div class="box-body table-responsive no-padding">
        <table class="table table-striped" style="font-size: larger;">
          <tr>
            <th style="text-align: center; width: 5%;">#</th>
            <th style="text-align: center; width: 25%;">Nama Kegiatan</th>
            <th style="text-align: center; width: 10%;">Hari</th>
            <th style="text-align: center; width: 20%;">Tgl. Kegiatan</th>
            <th style="text-align: center; width: 10%;">Waktu Mulai</th>
            <th style="text-align: center; width: 30%;">Pelayan/Sharing Firman</th>
          </tr>
          <?php
            $i=1;
            foreach ($schedule_list as $row) {
              if ($row['today_date'] === date('d')) {
                echo '
                  <tr style="background-color:#337ab7 !important; color: #fff; font-weight: bold;">
                    <td style="text-align: center; width: 5%;">'.$i.'.</td>
                    <td style="text-align: left; width: 25%;">'.$row['activity_name'].'</td>
                    <td style="text-align: left; width: 10%;">'.$row['day_name'].'</td>
                    <td style="text-align: center; width: 20%;">'.$row['tgl'].'</td>
                    <td style="text-align: center; width: 10%;">'.$row['jam_mulai'].'</td>
                    <td style="text-align: left; width: 30%;">'.$row['remarks'].'</td>
                ';
              } else {
                echo '
                  <tr>
                    <td style="text-align: center; width: 5%;">'.$i.'.</td>
                    <td style="text-align: left; width: 25%;">'.$row['activity_name'].'</td>
                    <td style="text-align: left; width: 10%;">'.$row['day_name'].'</td>
                    <td style="text-align: center; width: 20%;">'.$row['tgl'].'</td>
                    <td style="text-align: center; width: 10%;">'.$row['jam_mulai'].'</td>
                    <td style="text-align: left; width: 30%;">'.$row['remarks'].'</td>
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
                  <tr>
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
  <?php if ($this->ion_auth->in_group(array('pengerja'))) { ?>

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

<!-- Put Caorousel here -->

<!-- END OF CAROUSEL -->

</div>