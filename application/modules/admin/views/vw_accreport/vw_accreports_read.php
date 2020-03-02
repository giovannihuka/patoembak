
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Tanggal Aktifitas','activity_date',$vw_accreport['activity_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Yearnum','yearnum',$vw_accreport['yearnum'],'readonly'); ?>
				<?php echo $form->bs3_text('Monthnum','monthnum',$vw_accreport['monthnum'],'readonly'); ?>
				<?php echo $form->bs3_text('Weeknum','weeknum',$vw_accreport['weeknum'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Kegiatan','activity_name',$vw_accreport['activity_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Amount','amount',$vw_accreport['amount'],'readonly'); ?>
				<?php echo $form->bs3_text('People','people',$vw_accreport['people'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'vw_accreport\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
