
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_date('Tanggal Aktifitas','activity_date',$vw_accreport['activity_date'],'','','Masukkan Tanggal Aktifitas'); ?>
				<?php echo $form->bs3_text('Yearnum','yearnum',$vw_accreport['yearnum'],'','','Masukkan Yearnum'); ?>
				<?php echo $form->bs3_text('Monthnum','monthnum',$vw_accreport['monthnum'],'','','Masukkan Monthnum'); ?>
				<?php echo $form->bs3_text('Weeknum','weeknum',$vw_accreport['weeknum'],'','','Masukkan Weeknum'); ?>
				<?php echo $form->bs3_text('Nama Kegiatan','activity_name',$vw_accreport['activity_name'],'','','Masukkan Nama Kegiatan'); ?>
				<?php echo $form->bs3_text('Amount','amount',$vw_accreport['amount'],'','','Masukkan Amount'); ?>
				<?php echo $form->bs3_text('People','people',$vw_accreport['people'],'','','Masukkan People'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'vw_accreport\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
