
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Kategori','category_name',$ref_expense['category_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$ref_expense['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'ref_expense\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
