<?php include_once "inc/header.html"; ?>
	<?php 
		if (isset($page)) {
			include_once "pages/".$page.'.html';
		}
	 ?>
<?php include_once "inc/footer.html"; ?>			
