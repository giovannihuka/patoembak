<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body">
            	<?php echo $form->open(); ?>
							<?php echo $form->bs3_date('Log Date','log_date'); ?>
						</div>
					</div>
				</div>
			</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
						<div class="panel-heading">
							<strong>Log Date: <?php echo $log_date; ?></strong>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table" id="log_table">
									<thead>
										<tr>
											<th style="text-align: center;">ID</th>
											<th style="text-align: center;">Error Level</th>
											<th style="text-align: center;">Error Timestamp</th>
											<th style="text-align: center;">Messages</th>
										</tr>
									</thead>
									<tbody>
<?php
	
	if ($cols) 
	{
		$classes = array(
			'ERROR' => 'danger',
			'DEBUG' => 'warning',
			'INFO'  => 'info'
		);
		for ($i=0; $i<count($cols['level']); $i++) {
		?>
			<tr>
				<td class="<?php echo $classes[$cols['level'][$i]]; ?>"><?php echo $i+1; ?></td>
				<td class="<?php echo $classes[$cols['level'][$i]]; ?>" style="font-weight: bold;"><?php echo $cols['level'][$i]; ?></td>
				<td class="<?php echo $classes[$cols['level'][$i]]; ?>"><?php echo $cols['time'][$i]; ?></td>
				<td class="<?php echo $classes[$cols['level'][$i]]; ?>"><?php echo $cols['message'][$i]; ?></td>
			</tr>
<?php
	}
} else {
?>
	<tr><td>No data found</td></tr>
<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
