<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container">
	<!-- <p>view file: /application/views/video_list/video_list.php</p> -->
	<?php echo $form->open(); ?>
	<?php
		$data = $videos->result_array();
		$rowCount = 0;
		$numOfCols = 4;
		$maxColWidth = 12/$numOfCols;
		?>

		<div class="row">
		<?php
		if (count($data)>0 ) {
			foreach ($data as $row){
			?>  
		        <div class="col-sm-<?php echo $maxColWidth; ?>">
		            <?php echo $form->bs3_youtube($row['video_title'],$row['video_url'],'thumbnail',$row['id']); ?>
		        </div>
			<?php
		    	$rowCount++;
		    	if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
			}
		} else {
			?>
<!-- 			<div class="col-lg-12" style="background-color: navy; color: white;">
				<h3>No Data Found</h3>
			</div> -->

			<div class="w3-card-4 w3-round-large">
			  <div class="box box-primary">
			    <div class="box-header">
			      <h3 class="box-title">No Data Found</h3>
			    </div>
			  </div>
			</div>

		<?php
		}
			?>

		</div>


	<?php echo $form->close(); ?>
</div>