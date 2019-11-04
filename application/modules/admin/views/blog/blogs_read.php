
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Kategori Blog','blog_category',$blog['blog_category'],'readonly'); ?>
				<?php echo $form->bs3_text('Judul','title',$blog['title'],'readonly'); ?>
				<?php echo $form->bs3_text('Isi Blog','content_text',$blog['content_text'],'readonly'); ?>
				<?php echo $form->bs3_text('Tgl. Publikasi','publish_date',$blog['publish_date'],'readonly'); ?>
				<?php echo $form->bs3_text('Tgl. Akhir Publikasi','end_date',$blog['end_date'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'blog\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
