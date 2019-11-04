
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <?php echo $map['html']; ?>
				<?php echo $map['js']; ?>
				<br>
				<?php echo $form->bs3_text('Nama Gereja','company_name',$contract['company_name'],'readonly'); ?>
				<?php echo $form->bs3_text('Nama Gembala','pic_name',$contract['pic_name'],'readonly'); ?>
				<?php echo $form->bs3_textarea('Alamat Gereja','company_address',$contract['company_address'],'readonly'); ?>
				<?php echo $form->bs3_text('Telepon','company_phone1',$contract['company_phone1'],'readonly'); ?>
				<?php echo $form->bs3_text('Telepon Lain','company_phone2',$contract['company_phone2'],'readonly'); ?>
				<?php echo $form->bs3_text('Hand Phone','pic_phone',$contract['pic_phone'],'readonly'); ?>
				<?php echo $form->bs3_text('Email','email_address',$contract['email_address'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Berdiri','start_date',$contract['start_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Tanggal Tutup','terminate_date',$contract['terminate_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Status','status_data',$contract['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'contract\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
