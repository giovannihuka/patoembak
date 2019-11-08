
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Kategori','category_name','','','','Masukkan Kategori'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'ref_income\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
