
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_dropdown('ID Keluarga','family_id','',$relationship['family_id'],'','Pilih ID Keluarga'); ?>
				<?php echo $form->bs3_dropdown('Individu 1','individu_1_id','',$relationship['individu_1_id'],'','Pilih Individu 1'); ?>
				<?php echo $form->bs3_dropdown('Individu 2','individu_2_id','',$relationship['individu_2_id'],'','Pilih Individu 2'); ?>
				<?php echo $form->bs3_dropdown('Hubungan Dalam Keluarga','relationship_type_id','',$relationship['relationship_type_id'],'','Pilih Hubungan Dalam Keluarga'); ?>
				<?php echo $form->bs3_dropdown('Individu 1 Status','ind_1_role_id','',$relationship['ind_1_role_id'],'','Pilih Individu 1 Status'); ?>
				<?php echo $form->bs3_dropdown('Individu 2 Status','ind_2_role_id','',$relationship['ind_2_role_id'],'','Pilih Individu 2 Status'); ?>
				<?php echo $form->bs3_date('Tanggal Mulai Hubungan','date_relationship_start',$relationship['date_relationship_start'],'','','Masukkan Tanggal Mulai Hubungan'); ?>
				<?php echo $form->bs3_date('Tanggal Akhir Hubungan','date_relationship_end',$relationship['date_relationship_end'],'','','Masukkan Tanggal Akhir Hubungan'); ?>
				<?php echo $form->bs3_text('Kota','relationship_place',$relationship['relationship_place'],'','','Masukkan Kota'); ?>
				<?php echo $form->bs3_text('Keterangan','remarks',$relationship['remarks'],'','','Masukkan Keterangan'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data','',$relationship['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'relationship\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
