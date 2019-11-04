
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_dropdown('Status','family_id','','','','Pilih ID Keluarga'); ?>
				<?php echo $form->bs3_dropdown('Status','individu_1_id','','','','Pilih Individu 1'); ?>
				<?php echo $form->bs3_dropdown('Status','individu_2_id','','','','Pilih Individu 2'); ?>
				<?php echo $form->bs3_dropdown('Status','relationship_type_id','','','','Pilih Hubungan Dalam Keluarga'); ?>
				<?php echo $form->bs3_dropdown('Status','ind_1_role_id','','','','Pilih Individu 1 Status'); ?>
				<?php echo $form->bs3_dropdown('Status','ind_2_role_id','','','','Pilih Individu 2 Status'); ?>
				<?php echo $form->bs3_date('Tanggal Mulai Hubungan','date_relationship_start','','','','Masukkan Tanggal Mulai Hubungan'); ?>
				<?php echo $form->bs3_date('Tanggal Akhir Hubungan','date_relationship_end','','','','Masukkan Tanggal Akhir Hubungan'); ?>
				<?php echo $form->bs3_text('Kota','relationship_place','','','','Masukkan Kota'); ?>
				<?php echo $form->bs3_text('Keterangan','remarks','','','','Masukkan Keterangan'); ?>
				<?php echo $form->bs3_dropdown('Status','status_data','','','','Pilih Status Data'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'relationship\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
