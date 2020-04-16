
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <?php echo $form->bs3_dropdown('Pemasukan / Pengeluaran','in_out',$in_out_list,$accounting['in_out'],'','Masukkan Pemasukan / Pengeluaran'); ?>
				<?php echo $form->bs3_dropdown('Nama Aktifitas','activity_id',$activity_list,$accounting['activity_id'],'','Masukkan Nama Aktifitas'); ?>
				<?php echo $form->bs3_date('Tanggal Aktifitas','activity_date',$accounting['activity_date'],'','','Masukkan Tanggal Aktifitas'); ?>
				<?php echo $form->bs3_text('Jumlah Uang','amount',$accounting['amount'],'','','Masukkan Jumlah Uang'); ?>
				<?php echo $form->bs3_text('Jemaat','people',$accounting['people'],'','','Masukkan Jemaat'); ?>
				<?php echo $form->bs3_text('Keterangan','description',$accounting['description'],'','','Masukkan Keterangan'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$accounting['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'accounting\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
