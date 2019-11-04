
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <div class="row">
                	<div class="col-md-9">
						<?php echo $form->bs3_text('Nama Lengkap','full_name',$member['full_name'],'','','Masukkan Nama Lengkap'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Nama Panggilan','nick_name',$member['nick_name'],'','','Masukkan Nama Panggilan'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<?php echo $form->bs3_dropdown('Jenis Kelamin','gender',$gender_list,$member['gender'],'','Pilih Jenis Kelamin'); ?>
					</div>
					<div class="col-md-4">
						<?php echo $form->bs3_dropdown('Gol. Darah','blood_typeid',$blood_list,$member['blood_typeid'],'','Pilih Gol. Darah'); ?>
					</div>
					<div class="col-md-4">						
						<?php echo $form->bs3_date('Tanggal Kelahiran','birth_date',$member['birth_date'],'','','Masukkan Tanggal Kelahiran'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-9">
						<?php echo $form->bs3_text('Kota Kelahiran','birth_city',$member['birth_city'],'','','Masukkan Kota Kelahiran'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_smartphone('No. Handphone','phone_num',$member['phone_num'],'','','Masukkan No. Handphone'); ?>
					</div>
				</div>
				<?php echo $form->bs3_dropdown('Gereja Cabang','contract_id',$contract_list,$member['contract_id'],'','Pilih Cabang'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$member['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'member\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
