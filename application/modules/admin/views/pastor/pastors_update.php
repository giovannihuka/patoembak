
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Gembala','remarks',$pastor['remarks'],'','','Masukkan Nama Gembala'); ?>
				<?php echo $form->bs3_dropdown('Jabatan','rank_id',$rank_list,$pastor['rank_id'],'','Pilih Jabatan'); ?>
                <?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$pastor['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'pastor\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
