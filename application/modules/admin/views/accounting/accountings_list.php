
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
                            <?php echo anchor(site_url('admin/accounting/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin/accounting/excel'), 'Excel', 'class="btn btn-primary"'); ?>                    </div>
                </div>
                <div class="table-responsive">
	    
        <table class="table table-bordered table-striped nowrap" id="mytable" style="width: 100%">
            <thead>
                <tr>
                    <th width="45px">No</th>
		    <th>Pemasukan / Pengeluaran</th>
		    <th>Jenis Pembayaran</th>
		    <th>Nama Aktifitas</th>
		    <th>Tanggal Aktifitas</th>
		    <th>Jumlah</th>
		    <th>Keterangan</th>
		    <th>Status Data</th>
		    <th width="80px">Aksi</th>
                </tr>
            </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>