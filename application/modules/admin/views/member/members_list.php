
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="row" style="margin-bottom: 4px">
                        <div class="col-md-8">
                            <div style="margin-top: 4px"  id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <?php echo anchor(site_url('admin/member/create'), 'Create', 'class="btn btn-primary"'); ?>                    
                            <?php echo anchor(site_url('admin/member/excel'), 'Export to Excel', 'class="btn btn-primary"'); ?>
                        </div>
                </div>
                <div class="table-responsive">
	    
        <table class="table table-bordered table-striped nowrap" id="mytable" style="width: 100%">
            <thead>
                <tr>
                    <th width="45px">No</th>
                    <th width="80px">Aksi</th>
<!-- 		    <th>Nama Depan</th>
		    <th>Nama Tengah</th>
		    <th>Nama Belakang</th> -->
            <th>Nama Lengkap</th>
		    <th>Nama Panggilan</th>
            <th>Jenis Kelamin</th>
            <th>Gol. Darah</th>
		    <th>Tanggal Kelahiran</th>
		    <th>Kota Kelahiran</th>
		    <th>No. Handphone</th>
		    <th>Gereja Cabang</th>
		    <th>Status Data</th>
		    
                </tr>
            </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>