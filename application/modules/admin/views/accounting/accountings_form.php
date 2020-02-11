
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_dropdown('Pemasukan / Pengeluaran','in_out',$in_out,'','','Pilih Pemasukan / Pengeluaran'); ?>
				<?php echo $form->bs3_dropdown('Nama Aktifitas','activity_id',$activity_list,'','','Masukkan Nama Aktifitas'); ?>
				<?php echo $form->bs3_date('Tanggal Aktifitas','activity_date','','','','Masukkan Tanggal Aktifitas'); ?>
				<?php echo $form->bs3_text('Jumlah Uang','amount','','','','Masukkan Jumlah Uang'); ?>
				<?php echo $form->bs3_text('Jemaat','people','','','','Masukkan Jemaat'); ?>
				<?php echo $form->bs3_text('Keterangan','description','','','','Masukkan Keterangan'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'accounting\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
