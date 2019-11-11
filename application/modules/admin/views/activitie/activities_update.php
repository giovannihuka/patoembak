
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_dropdown('Nama Kegiatan','ref_activityid',$activity_list,$activitie['ref_activityid'],'','Pilih Nama Kegiatan'); ?>
                <?php echo $form->bs3_date('Tgl. Kegiatan','activity_date',$activitie['activity_date'],'','','Tanggal Kegiatan'); ?>
                <?php echo $form->bs3_textarea('Keterangan','remarks',$activitie['remarks'],'','','Keterangan'); ?>
				<?php echo $form->bs3_time('Mulai Kegiatan','time_start',$activitie['time_start'],'','','Masukkan Mulai Kegiatan'); ?>
				<?php echo $form->bs3_time('Selesai Kegiatan','time_end',$activitie['time_end'],'','','Masukkan Selesai Kegiatan'); ?>
				<?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$activitie['status_data'],'','Pilih Status Data'); ?>
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'activitie\'">Cancel</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
