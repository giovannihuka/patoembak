
<!-- <div class="container" style="margin: 0px 5px 3px 5px;"> -->
<!-- <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> -->
<div class="container"">

<?php if ($this->ion_auth->logged_in()): ?>
  <?php if ($this->ion_auth->in_group(array('pengerja'))) { ?>

    <div class="w3-card-4 w3-round-large">
      <div class="jumbotron" style="background: transparent !important;">
        <p align="center" style="font-weight: bold;">
          GIOVANNI H. HUKA
        </p>
      </div>
    </div>

  <?php } ?>
<?php endif; ?>


<?php if (!$this->ion_auth->logged_in()): ?>
    <div class="w3-card-4 w3-round-large">
      <div class="jumbotron" style="background: navy !important;">
        <p align="center" style="font-weight: bold; color: white;">
          You are not allowed to access this page
        </p>
      </div>
    </div>
<?php endif; ?>

<!-- Put Caorousel here -->

<!-- END OF CAROUSEL -->

</div>