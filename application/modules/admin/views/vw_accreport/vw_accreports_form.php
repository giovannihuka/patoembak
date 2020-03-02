
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_date('Tanggal Aktifitas','activity_date','','','','Masukkan Tanggal Aktifitas'); ?>
				<?php echo $form->bs3_text('Yearnum','yearnum','','','','Masukkan Yearnum'); ?>
				<?php echo $form->bs3_text('Monthnum','monthnum','','','','Masukkan Monthnum'); ?>
				<?php echo $form->bs3_text('Weeknum','weeknum','','','','Masukkan Weeknum'); ?>
				<?php echo $form->bs3_text('Nama Kegiatan','activity_name','','','','Masukkan Nama Kegiatan'); ?>
				<?php echo $form->bs3_text('Amount','amount','','','','Masukkan Amount'); ?>
				<?php echo $form->bs3_text('People','people','','','','Masukkan People'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'vw_accreport\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
