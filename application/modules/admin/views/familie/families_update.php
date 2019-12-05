
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-12">

        <div class="box box-primary">
            <div class="box-body">
            	
                <?php echo $form->open(); ?>
                    <div class="row">
						<div class="col-md-6">
							<?php echo $form->bs3_text('Nama Keluarga','family_name',$familie['family_name'],'','','Masukkan Nama Keluarga'); ?>
						</div>
                		<div class="col-md-6">
							<?php echo $form->bs3_text('Kepala Keluarga','head_fam_id',$familie['family_head_full_name'],'readonly'); ?>
						</div>
					</div>
                    <div class="row">
                		<div class="col-md-6">
							<?php echo $form->bs3_textarea('Alamat Rumah','home_address',$familie['home_address'],'','','Masukkan Alamat Rumah'); ?>
						</div>
						<div class="col-md-6">
							<?php echo $form->bs3_textarea('Keterangan','family_description',$familie['family_description'],'','','Masukkan Keterangan'); ?>
						</div>
					</div>
                    <div class="row">
                		<div class="col-md-3">
							<?php echo $form->bs3_dropdown('Propinsi','ref_provinceid',$province_list,$familie['province_id'],'','','Masukkan Propinsi'); ?>
						</div>
						<div class="col-md-3">
							<?php echo $form->bs3_dropdown('Kabupaten','ref_regencies',$regency_list,$familie['regency_id'],'','','Masukkan Kabupaten'); ?>
						</div>
						<div class="col-md-3">
							<?php echo $form->bs3_dropdown('Kecamatan','ref_districts',$district_list,$familie['district_id'],'','','Masukkan Kecamatan'); ?>
						</div>
						<div class="col-md-3">
							<?php echo $form->bs3_dropdown('Kelurahan','ref_villages',$village_list,$familie['village_id'],'','','Masukkan Kelurahan'); ?>
						</div>
					</div>
				
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$familie['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'familie\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
