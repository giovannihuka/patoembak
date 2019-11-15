
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_textarea('Firman Tuhan','scriptures_text',$scripture['scriptures_text'],'','','Masukkan Firman Tuhan'); ?>
				<?php echo $form->bs3_text('Pasal Alkitab','scripture_section',$scripture['scripture_section'],'','','Masukkan Pasal Alkitab'); ?>
				<?php echo $form->bs3_date('Tgl. Awal','start_date',$scripture['start_date'],'','','Masukkan Tgl. Awal'); ?>
				<?php echo $form->bs3_date('Tgl. Selesai','end_date',$scripture['end_date'],'','','Masukkan Tgl. Selesai'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$scripture['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'scripture\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
