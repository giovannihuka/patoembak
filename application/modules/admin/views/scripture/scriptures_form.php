
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_textarea('Firman Tuhan','scriptures_text','','','','Masukkan Firman Tuhan'); ?>
				<?php echo $form->bs3_text('Pasal Alkitab','scripture_section','','','','Masukkan Pasal Alkitab'); ?>
				<?php echo $form->bs3_date('Tgl. Awal','start_date','','','','Masukkan Tgl. Awal'); ?>
				<?php echo $form->bs3_date('Tgl. Selesai','end_date','','','','Masukkan Tgl. Selesai'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'scripture\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
