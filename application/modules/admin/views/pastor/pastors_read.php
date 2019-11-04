
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Gembala','remarks',$pastor['remarks'],'readonly'); ?>
                <?php echo $form->bs3_dropdown('Jabatan','rank_id',$rank_list,$pastor['rank_id'],'','Pilih Jabatan',0,1); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$pastor['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'pastor\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
