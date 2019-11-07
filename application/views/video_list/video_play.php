<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="container">
		<?php $data = $videos; ?>
		<div class="row" style="margin: 0px 2px 0px 2px;">
	        <?php echo $form->bs3_youtube($data['video_title'],$data['video_url'],'player'); ?>
	        <?php echo $form->bs3_ckeditor('Deskripsi','video_desc',$data['video_desc']) ?>
	    </div>
</div>