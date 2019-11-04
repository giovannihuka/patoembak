
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Rekening Induk','parent_id',$account['parent_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Tipe Rekening','ref_charttype',$account['ref_charttype'],'readonly'); ?>
				<?php echo $form->bs3_text('Level','level_num',$account['level_num'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Rekening','chart_name',$account['chart_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$account['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'account\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
