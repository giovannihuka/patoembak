
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Jabatan','rank_name',$ref_rank['rank_name'],'','','Masukkan Nama Jabatan'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$ref_rank['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'ref_rank\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
