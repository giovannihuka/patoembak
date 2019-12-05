
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <div class="row">
                	<div class="col-md-9">
						<?php echo $form->bs3_text('Nama Lengkap','full_name','','','','Masukkan Nama Lengkap'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Nama Panggilan','nick_name','','','','Masukkan Nama Panggilan'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<?php echo $form->bs3_dropdown('Jenis Kelamin','gender',$gender_list,'','','Pilih Jenis Kelamin'); ?>
					</div>
					<div class="col-md-4">
						<?php echo $form->bs3_dropdown('Gol. Darah','blood_typeid',$blood_list,'','','Pilih Gol. Darah'); ?>
					</div>
					<div class="col-md-4">
						<?php echo $form->bs3_date('Tanggal Kelahiran','birth_date','','','','Masukkan Tanggal Kelahiran'); ?>
					</div>
				</div>
				<?php echo $form->bs3_text('Kota Kelahiran','birth_city','','','','Masukkan Kota Kelahiran'); ?>
				<?php echo $form->bs3_smartphone('No. Handphone','phone_num','','','','Masukkan No. Handphone'); ?>
				<?php echo $form->bs3_dropdown('Gereja Cabang','contract_id',$contract_list,'','','Pilih Cabang'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'member\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
