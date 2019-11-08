
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Pemasukan / Pengeluaran','in_out',$accounting['in_out'],'readonly'); ?>
				<?php echo $form->bs3_text('Jenis Pembayaran','category_id',$accounting['category_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Aktifitas','activity_id',$accounting['activity_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Aktifitas','activity_date',$accounting['activity_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Jumlah','amount',$accounting['amount'],'readonly'); ?>
				<?php echo $form->bs3_text('Keterangan','description',$accounting['description'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$accounting['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'accounting\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
