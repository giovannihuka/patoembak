
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Tgl. Kegiatan','activity_date',$attendance['activity_date'],'readonly'); ?>
                <?php echo $form->bs3_text('Nama Kegiatan','ref_activityid',$attendance['activity_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Jumlah Yg Hadir','qty',$attendance['qty'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'attendance\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
