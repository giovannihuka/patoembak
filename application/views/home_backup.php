
<!-- <div class="container" style="margin: 0px 5px 3px 5px;"> -->
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container"">

<!-- Birthday information -->
    <?php if (count($bday_list)>0) { ?>
      <?php if ($this->ion_auth->logged_in()): ?>
        <?php if ($this->ion_auth->in_group(array('pengerja'))) { ?>
          <div class="row">
            <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> -->
            <div class="col-lg-12">
              <div class="table-responsive" style="border-radius: 4px;">
                <table id="tbl-bday" class=" table-striped" cellpadding="10" width="100%">
                  <thead style="background-color: #0073b7 !important; color: white;">
                    <tr>
                      <th style="text-align: center;" colspan="2">Berulang Tahun Bulan Ini</th>
                    </tr>
                    <tr>
                      <th style="text-align: center;">Nama</th>
                      <th style="text-align: center;">Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($bday_list as $row) {
                      if ($row['tgl_ulangtahun'] === date('d')) {
                        echo '
                          <tr style="background-color:#ffd24d !important; color: #000; font-weight: bold;">
                            <td>'.$row['full_name'].'</td>
                            <td style="text-align: center;">'.$row['tgl_ulangtahun'].'</td>
                          ';
                      } else {
                        echo '
                          <tr>
                            <td>'.$row['full_name'].'</td>
                            <td style="text-align: center;">'.$row['tgl_ulangtahun'].'</td>
                          ';
                      }
                    } 
                  ?>
                  </tbody>
                </table>  
              </div>
            </div>
          </div>  <!-- END of ROW -->

          <div class="row">
          <!-- Small boxes (Stat box) -->
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding-left: 5px; padding-right: 5px;">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>VIDEO</h3>
                <p>GBI Raffles</p>
              </div>
              <div class="icon">
                <i class="fa fa-film"></i>
              </div>
              <a href="video_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- </div> -->
          </div>  <!-- END of ROW -->


        <?php } ?>
      <?php endif; ?>
    <?php } ?>

<!-- END of BIRTHDAY INFORMATION -->

<!-- <div class="jumbotron">
  <h1>GBI Raffles</h1>
  <p>Tetapi carilah dahulu Kerajaan Allah dan kebenarannya (Mat 6:33a)</p>
</div>  -->


<!-- Put Caorousel here -->

<!-- END OF CAROUSEL -->

<!-- Small boxes -->
  <div class="row">

      <!-- Small boxes (Stat box) -->
      <!-- <div class="row"> -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding-left: 5px; padding-right: 5px;">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>CABANG</h3>
              <p>Lokasi Gereja</p>
            </div>
            <div class="icon">
              <i class="fa fa-map-marker"></i>
            </div>
            <a href="map" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        <!-- </div> -->
        <!-- ./col -->
      </div>

      <!-- Small boxes (Stat box) -->
      <!-- <div class="row"> -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding-left: 5px; padding-right: 5px;">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>VIDEO</h3>
              <p>Pastor Message</p>
            </div>
            <div class="icon">
              <i class="fa fa-film"></i>
            </div>
            <a href="video_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      <!-- </div> -->
  </div>
<!-- END OF SMALL BOXES -->

</div>