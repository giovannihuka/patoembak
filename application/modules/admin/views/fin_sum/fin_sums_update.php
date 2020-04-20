
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Tahun','year_num',$fin_sum['year_num'],'','','Masukkan Tahun'); ?>
				<?php echo $form->bs3_text('Bulan','month_num',$fin_sum['month_num'],'','','Masukkan Bulan'); ?>
				<?php echo $form->bs3_text('Minggu Ke','week_num',$fin_sum['week_num'],'','','Masukkan Minggu Ke'); ?>
				<?php echo $form->bs3_text('Jumlah Jemaat','qty_person',$fin_sum['qty_person'],'','','Masukkan Jumlah Jemaat'); ?>
				<?php echo $form->bs3_text('Pemasukkan','amount',$fin_sum['amount'],'','','Masukkan Pemasukkan'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data','',$fin_sum['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'fin_sum\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
