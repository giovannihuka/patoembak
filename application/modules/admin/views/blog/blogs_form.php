
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Kategori Blog','blog_category','','','','Masukkan Kategori Blog'); ?>
				<?php echo $form->bs3_text('Judul','title','','','','Masukkan Judul'); ?>
				<?php echo $form->bs3_text('Isi Blog','content_text','','','','Masukkan Isi Blog'); ?>
				<?php echo $form->bs3_text('Tgl. Publikasi','publish_date','','','','Masukkan Tgl. Publikasi'); ?>
				<?php echo $form->bs3_text('Tgl. Akhir Publikasi','end_date','','','','Masukkan Tgl. Akhir Publikasi'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'blog\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
