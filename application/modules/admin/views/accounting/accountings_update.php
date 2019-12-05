
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Pemasukan / Pengeluaran','in_out',$accounting['in_out'],'','','Masukkan Pemasukan / Pengeluaran'); ?>
				<?php echo $form->bs3_text('Jenis Pembayaran','category_id',$accounting['category_id'],'','','Masukkan Jenis Pembayaran'); ?>
				<?php echo $form->bs3_text('Nama Aktifitas','activity_id',$accounting['activity_id'],'','','Masukkan Nama Aktifitas'); ?>
				<?php echo $form->bs3_date('Tanggal Aktifitas','activity_date',$accounting['activity_date'],'','','Masukkan Tanggal Aktifitas'); ?>
				<?php echo $form->bs3_text('Jumlah','amount',$accounting['amount'],'','','Masukkan Jumlah'); ?>
				<?php echo $form->bs3_text('Keterangan','description',$accounting['description'],'','','Masukkan Keterangan'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data','',$accounting['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'accounting\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
