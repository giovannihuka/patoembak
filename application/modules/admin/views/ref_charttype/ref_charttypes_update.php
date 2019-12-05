
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Tipe Chart','type_name',$ref_charttype['type_name'],'','','Masukkan Nama Tipe Chart'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$ref_charttype['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'ref_charttype\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
