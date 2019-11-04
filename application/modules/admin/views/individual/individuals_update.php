
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <div class="row">
                	<div class="col-md-3">
                		<?php echo $form->bs3_text('Nomor Induk','individual_code',$individual['individual_code'],'readonly'); ?>
                	</div>
                	<div class="col-md-6">
						<?php echo $form->bs3_text('Nama Lengkap','full_name',$individual['full_name'],'','','Masukkan Nama Lengkap'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Nama Panggilan','nick_name',$individual['nick_name'],'','','Masukkan Nama Panggilan'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Jenis Kelamin','gender',$gender_list,$individual['gender'],'','Pilih Jenis Kelamin'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Gol. Darah','blood_typeid',$blood_list,$individual['blood_typeid'],'','Pilih Gol. Darah'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Kota Kelahiran','birth_city',$individual['birth_city'],'','','Masukkan Kota Kelahiran'); ?>
					</div>
					<div class="col-md-3">						
						<?php echo $form->bs3_date('Tanggal Kelahiran','birth_date',$individual['birth_date'],'','','Masukkan Tanggal Kelahiran'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Status Pernikahan','marriage_status',$marriage_status,$individual['marriage_status'],'','Pilih Status Pernikahan'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_smartphone('No. Handphone','phone_num',$individual['phone_num'],'','','Masukkan No. Handphone'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Gereja Cabang','contract_id',$contract_list,$individual['contract_id'],'','Pilih Cabang'); ?>
					</div>
				</div>
				
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$individual['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'individual\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
