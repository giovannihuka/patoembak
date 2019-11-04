
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Judul','video_title','','','','Masukkan Judul'); ?>
				<?php echo $form->bs3_textarea('Deskripsi','video_desc','','','','Masukkan Deskripsi'); ?>
				<script>
					window.onload = function() {
						CKEDITOR.replace('video_desc',{});
					};
				</script>
				<?php echo $form->bs3_text('URL','video_url','','','','Masukkan URL'); ?>
				<?php echo $form->bs3_date('Tgl. Publikasi','publish_date','','','','Masukkan Tgl. Publikasi'); ?>
				<?php echo $form->bs3_date('Tgl. Akhir Publikasi','end_date','','','','Masukkan Tgl. Akhir Publikasi'); ?>
				<?php echo $form->bs3_text('Urutan','sequence_num','','','','Masukkan Urutan'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'video\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
