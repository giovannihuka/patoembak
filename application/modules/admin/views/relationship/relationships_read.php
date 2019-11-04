
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('ID Keluarga','family_id',$relationship['family_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Individu 1','individu_1_id',$relationship['individu_1_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Individu 2','individu_2_id',$relationship['individu_2_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Hubungan Dalam Keluarga','relationship_type_id',$relationship['relationship_type_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Individu 1 Status','ind_1_role_id',$relationship['ind_1_role_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Individu 2 Status','ind_2_role_id',$relationship['ind_2_role_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Mulai Hubungan','date_relationship_start',$relationship['date_relationship_start'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Akhir Hubungan','date_relationship_end',$relationship['date_relationship_end'],'readonly'); ?>
				<?php echo $form->bs3_text('Kota','relationship_place',$relationship['relationship_place'],'readonly'); ?>
				<?php echo $form->bs3_text('Keterangan','remarks',$relationship['remarks'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$relationship['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'relationship\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
