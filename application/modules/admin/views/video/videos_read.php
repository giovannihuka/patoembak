
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Judul','video_title',$video['video_title'],'readonly'); ?>

                <div class="form-group">
                    <label for="video_desc">Deskripsi</label>
                    <div class="ckeditor_val">
                        <?php echo $video['video_desc']; ?>
                    </div>
                </div>

				<?php echo $form->bs3_text('URL','video_url',$video['video_url'],'readonly'); ?>
				<?php echo $form->bs3_text('Tgl. Publikasi','publish_date',$video['publish_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Tgl. Akhir Publikasi','end_date',$video['end_date'],'readonly'); ?>
                <?php echo $form->bs3_text('Urutan','sequence_num',$video['sequence_num'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$video['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'video\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
