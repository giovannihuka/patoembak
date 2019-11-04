
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <?php echo $form->bs3_dropdown('Tipe Rekening','ref_charttype',$type_chart_list,'','','Pilih Tipe Rekening'); ?>
				<?php echo $form->bs3_dropdown('Rekening Induk','parent_id',$account_list,'','','Pilih Rekening Induk'); ?>
				<?php echo $form->bs3_text('Kode Account','chart_num','','','','Masukkan Kode Rekening'); ?>
				<?php echo $form->bs3_text('Nama Rekening','chart_name','','','','Masukkan Nama Rekening'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'account\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
