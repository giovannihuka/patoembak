
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Gereja','company_name',$contract['company_name'],'','','Masukkan Nama Gereja'); ?>
				<?php echo $form->bs3_dropdown('Nama Gembala','pic_name',$pastor_list,$contract['pic_name'],'','','Masukkan Nama Gembala'); ?>
				<?php echo $form->bs3_textarea('Alamat Gereja','company_address',$contract['company_address'],'','','Masukkan Alamat Gereja'); ?>
				<?php echo $form->bs3_text('Langtitude','long_info',$contract['long_info'],'','','Masukkan Langtitude'); ?>
				<?php echo $form->bs3_text('Latitude','lat_info',$contract['lat_info'],'','','Masukkan Latitude'); ?>
				<?php echo $form->bs3_phone('Telepon','company_phone1',$contract['company_phone1'],'','','Masukkan Telepon'); ?>
				<?php echo $form->bs3_phone('Telepon Lain','company_phone2',$contract['company_phone2'],'','','Masukkan Telepon Lain'); ?>
				<?php echo $form->bs3_phone('Hand Phone','pic_phone',$contract['pic_phone'],'','','Masukkan Hand Phone'); ?>
				<?php echo $form->bs3_text('Email','email_address',$contract['email_address'],'','','Masukkan Email'); ?>
				<?php echo $form->bs3_date('Tanggal Berdiri','start_date',$contract['start_date'],'','','Masukkan Tanggal Berdiri'); ?>
				<?php echo $form->bs3_date('Tanggal Tutup','terminate_date',$contract['terminate_date'],'','','Masukkan Tanggal Tutup'); ?>
				<?php echo $form->bs3_dropdown('Status','status_data',$status_list,$contract['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'contract\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
