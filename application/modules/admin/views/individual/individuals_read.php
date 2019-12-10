
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
						<?php echo $form->bs3_text('Nama Lengkap','full_name',$individual['full_name'],'readonly'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Nama Panggilan','nick_name',$individual['nick_name'],'readonly'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Jenis Kelamin','gender',$gender_list,$individual['gender'],'','',0,1); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Gol. Darah','blood_typeid',$blood_list,$individual['blood_typeid'],'','',0,1); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Tanggal Kelahiran','birth_date',date('d-F-Y',strtotime($individual['birth_date'])),'readonly'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Kota Kelahiran','birth_city',$individual['birth_city'],'readonly'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<?php echo $form->bs3_text('No. Handphone','phone_num',$individual['phone_num'],'readonly'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Gereja Cabang','contract_id',$contract_list,$individual['contract_id'],'','',0,1); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_dropdown('Status Pernikahan','marriage_status',$marriage_list,$individual['marriage_status'],'','',0,1); ?>
					</div>
					<div class="col-md-3">
						<?php echo $form->bs3_text('Status Data','status_data',$individual['status_data'],'readonly'); ?>
					</div>
				</div>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'individual\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
