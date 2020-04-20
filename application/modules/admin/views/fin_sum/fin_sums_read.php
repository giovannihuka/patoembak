
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Tahun','year_num',$fin_sum['year_num'],'readonly'); ?>
				<?php echo $form->bs3_text('Bulan','month_num',$fin_sum['month_num'],'readonly'); ?>
				<?php echo $form->bs3_text('Minggu Ke','week_num',$fin_sum['week_num'],'readonly'); ?>
				<?php echo $form->bs3_text('Jumlah Jemaat','qty_person',$fin_sum['qty_person'],'readonly'); ?>
				<?php echo $form->bs3_text('Pemasukkan','amount',$fin_sum['amount'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$fin_sum['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'fin_sum\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
