
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Lengkap','full_name',$member['full_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Panggilan','nick_name',$member['nick_name'],'readonly'); ?>
				<?php echo $form->bs3_dropdown('Jenis Kelamin','gender',$gender_list,$member['gender'],'','',0,1); ?>
				<?php echo $form->bs3_dropdown('Gol. Darah','blood_typeid',$blood_list,$member['blood_typeid'],'','',0,1); ?>
				<?php echo $form->bs3_text('Tanggal Kelahiran','birth_date',date('d-F-Y',strtotime($member['birth_date'])),'readonly'); ?>
				<?php echo $form->bs3_text('Kota Kelahiran','birth_city',$member['birth_city'],'readonly'); ?>
				<?php echo $form->bs3_text('No. Handphone','phone_num',$member['phone_num'],'readonly'); ?>
				<?php echo $form->bs3_dropdown('Gereja Cabang','contract_id',$contract_list,$member['contract_id'],'','',0,1); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$member['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'member\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
