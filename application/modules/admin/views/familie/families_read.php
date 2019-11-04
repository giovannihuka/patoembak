
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Kepala Keluarga','head_fam_id',$familie['head_fam_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Keluarga','family_name',$familie['family_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Keterangan','family_description',$familie['family_description'],'readonly'); ?>
				<?php echo $form->bs3_text('Alamat Rumah','home_address',$familie['home_address'],'readonly'); ?>
				<?php echo $form->bs3_text('Propinsi','province_id',$familie['province_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Kabupaten','regency_id',$familie['regency_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Kecamatan','district_id',$familie['district_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Kelurahan','village_id',$familie['village_id'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$familie['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'familie\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
