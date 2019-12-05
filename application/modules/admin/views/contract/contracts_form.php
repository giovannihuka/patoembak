
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <div class="row">
                	<div class="col-md-6">
						<?php echo $form->bs3_text('Nama Gereja','company_name','','','','Masukkan Nama Gereja'); ?>
					</div>
					<div class="col-md-6">
						<?php echo $form->bs3_dropdown('Nama Gembala','pic_name',$pastor_list,'','','Masukkan Nama Gembala'); ?>
					</div>
				</div>
                <div class="row">
                	<div class="col-md-6">
                		<?php echo $form->bs3_textarea('Alamat Gereja','company_address','','','','Masukkan Alamat Gereja'); ?>
                	</div>
                	<div class="col-md-6">
                		<div class="row">
                			<div class="col-md-12">
                				<?php echo $form->bs3_text('Langtitude','long_info','','','','Masukkan Longtitude'); ?>
                			</div>
                		</div>
                		<div class="row">
                			<div class="col-md-12">
								<?php echo $form->bs3_text('Latitude','lat_info','','','','Masukkan Latitude'); ?>
							</div>
						</div>
                	</div>
                </div>

				<?php echo $form->bs3_phone('Telepon','company_phone1','','','','Masukkan Telepon'); ?>
				<?php echo $form->bs3_phone('Telepon Lain','company_phone2','','','','Masukkan Telepon Lain'); ?>
				<?php echo $form->bs3_smartphone('Hand Phone','pic_phone','','','','Masukkan Hand Phone'); ?>
				<?php echo $form->bs3_text('Email','email_address','','','','Masukkan Email'); ?>
				<?php echo $form->bs3_date('Tanggal Berdiri','start_date','','','','Masukkan Tanggal Berdiri'); ?>
				<?php echo $form->bs3_date('Tanggal Tutup','terminate_date','','','','Masukkan Tanggal Tutup'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'contract\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
