<!-- The Modal -->
<div id="myModal_single_post" class="modal">
	<div class="container_single_post">
		<img src="http://motaphoto.local/wp-content/uploads/2023/07/Contact-header.png" alt="">
				<?php
				// On insère le formulaire de demandes de renseignements
					echo do_shortcode('[contact-form-7 id="20" title="Contact"]');
					echo the_field('reférence');
					
				?>

	</div>
</div>

