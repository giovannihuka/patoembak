
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_date('Tgl. Kegiatan','activity_date',$attendance['activity_date'],'','','Masukkan Tgl. Kegiatan'); ?>
				<?php echo $form->bs3_dropdown('Nama Kegiatan','ref_activityid',$activity_list,$attendance['ref_activityid'],'','Pilih Nama Kegiatan'); ?>
				<?php echo $form->bs3_text('Jumlah Yg Hadir','qty',$attendance['qty'],'','','Masukkan Jumlah Yg Hadir'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'attendance\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
