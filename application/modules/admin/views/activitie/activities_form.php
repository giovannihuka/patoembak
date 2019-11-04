
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_dropdown('Nama Kegiatan','ref_activityid',$activity_list,'','','Pilih Nama Kegiatan'); ?>
				<?php echo $form->bs3_date('Tgl. Kegiatan','activity_date','','','','Tanggal Kegiatan'); ?>
				<?php echo $form->bs3_text('Pelayan Firman','remarks','','','','Pelayan Firman'); ?>
				<?php echo $form->bs3_time('Mulai Kegiatan','time_start','','','','Masukkan Mulai Kegiatan'); ?>
				<?php echo $form->bs3_time('Selesai Kegiatan','time_end','','','','Masukkan Selesai Kegiatan'); ?>
				<?php echo $form->bs3_text_hidden('Create Userid','create_userid'); ?>
				<?php echo $form->bs3_text_hidden('Update Userid','update_userid'); ?>
				<?php echo $form->bs3_text_hidden('Create Time','create_time'); ?>
				<?php echo $form->bs3_text_hidden('Update Time','update_time'); ?>
				<?php echo $form->bs3_submit('Create'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'activitie\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
