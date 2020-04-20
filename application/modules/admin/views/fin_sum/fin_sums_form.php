
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Tahun','year_num','','','','Masukkan Tahun'); ?>
				<?php echo $form->bs3_text('Bulan','month_num','','','','Masukkan Bulan'); ?>
				<?php echo $form->bs3_text('Minggu Ke','week_num','','','','Masukkan Minggu Ke'); ?>
				<?php echo $form->bs3_text('Jumlah Jemaat','qty_person','','','','Masukkan Jumlah Jemaat'); ?>
				<?php echo $form->bs3_text('Pemasukkan','amount','','','','Masukkan Pemasukkan'); ?>
				<?php echo $form->bs3_dropdown('Status','status_data','','','','Pilih Status Data'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'fin_sum\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
