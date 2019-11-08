
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_dropdown('Income/Expense','in_outid','',$ref_acccategorie['in_outid'],'','Pilih Income/Expense'); ?>
				<?php echo $form->bs3_text('Kategori','category_name',$ref_acccategorie['category_name'],'','','Masukkan Kategori'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data','',$ref_acccategorie['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'ref_acccategorie\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
