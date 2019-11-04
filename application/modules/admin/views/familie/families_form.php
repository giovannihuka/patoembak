
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_dropdown('Kepala Keluarga','head_fam_id',$individu_list,'','','Pilih Kepala Keluarga'); ?>
				<?php echo $form->bs3_text('Nama Keluarga','family_name','','','','Masukkan Nama Keluarga'); ?>
				<?php echo $form->bs3_text('Keterangan','family_description','','','','Masukkan Keterangan'); ?>
				<?php echo $form->bs3_textarea('Alamat Rumah','home_address','','','','Masukkan Alamat Rumah'); ?>
				<?php echo $form->bs3_dropdown('Propinsi','ref_provinceid',$province_list,'','','Masukkan Propinsi'); ?>
				<?php echo $form->bs3_dropdown('Kabupaten','ref_regencies',$regency_list,'','','Masukkan Kabupaten'); ?>
				<?php echo $form->bs3_dropdown('Kecamatan','ref_districts',$district_list,'','','Masukkan Kecamatan'); ?>
				<?php echo $form->bs3_dropdown('Kelurahan','ref_villages',$village_list,'','','Masukkan Kelurahan'); ?>
				
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'familie\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>

