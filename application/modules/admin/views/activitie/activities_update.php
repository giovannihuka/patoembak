
<?php echo $form->messages(); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>
                <div class="row">
                    <div class="col-md-9">
				        <?php echo $form->bs3_dropdown('Nama Kegiatan','ref_activityid',$activity_list,$activitie['ref_activityid'],'','Pilih Nama Kegiatan'); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->bs3_date('Tgl. Kegiatan','activity_date',$activitie['activity_date'],'','','Tanggal Kegiatan'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $form->bs3_textarea('Keterangan','remarks',$activitie['remarks'],'','','Keterangan'); ?>
                        <script>
                            window.onload = function() {
                                CKEDITOR.replace('remarks',{});
                            };
                        </script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
				        <?php echo $form->bs3_time('Mulai Kegiatan','time_start',$activitie['time_start'],'','','Masukkan Mulai Kegiatan'); ?>
                    </div>
                    <div class="col-md-4">
				        <?php echo $form->bs3_time('Selesai Kegiatan','time_end',$activitie['time_end'],'','','Masukkan Selesai Kegiatan'); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $form->bs3_dropdown('Status Data','status_data',$status_list,$activitie['status_data'],'','Pilih Status Data'); ?>
                    </div>
                </div>
				
				<?php echo $form->bs3_submit('Update'); ?>
            	<?php echo '<button type="reset" class="btn btn-default" onclick="location.href=\'activitie\'">Back to List</button>' ?>
            	<?php echo $form->close(); ?>
            </div>
        </div>
    </div>
</div>
