
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Income/Expense','in_outid',$ref_acccategorie['in_outid'],'readonly'); ?>
				<?php echo $form->bs3_text('Kategori','category_name',$ref_acccategorie['category_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$ref_acccategorie['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'ref_acccategorie\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
