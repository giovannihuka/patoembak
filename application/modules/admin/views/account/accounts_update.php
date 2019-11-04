
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <?php echo $form->bs3_dropdown('Tipe Rekening','ref_charttype',$type_chart_list,$account['ref_charttype'],'','Pilih Tipe Rekening'); ?>
                <?php echo $form->bs3_dropdown('Rekening Induk','parent_id',$account_list,$account['parent_id'],'','Pilih Rekening Induk'); ?>
                <?php echo $form->bs3_text('Kode Account','chart_num',$account['chart_num'],'','','Masukkan Kode Rekening'); ?>
				<?php echo $form->bs3_text('Nama Rekening','chart_name',$account['chart_name'],'','','Masukkan Nama Rekening'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$account['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'account\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
