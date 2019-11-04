
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_textarea('Firman Tuhan','scriptures_text',$scripture['scriptures_text'],'readonly'); ?>
				<?php echo $form->bs3_text('Pasal Alkitab','scripture_section',$scripture['scripture_section'],'readonly'); ?>
				<?php echo $form->bs3_text('Tgl. Awal','start_date',$scripture['start_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Tgl. Selesai','end_date',$scripture['end_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$scripture['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'scripture\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
