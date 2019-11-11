
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
				<?php echo $form->bs3_text('Nama Kegiatan','activity_name',$activitie['activity_name'],'readonly'); ?>
                <?php echo $form->bs3_text('Tgl. Kegiatan','tgk',$activitie['tgl'],'readonly'); ?>
                <?php echo $form->bs3_text('Keterangan','remarks',$activitie['remarks'],'readonly'); ?>
				<?php echo $form->bs3_text('Mulai Kegiatan','time_start',$activitie['time_start'],'readonly'); ?>
				<?php echo $form->bs3_text('Selesai Kegiatan','time_end',$activitie['time_end'],'readonly'); ?>
				<?php echo $form->bs3_text('Status Data','status_data',$activitie['status_data'],'readonly'); ?>
				<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'activitie\'">Back</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
