<?php
	$css = "public/css/style.css";
	ob_start(); 
?>
	<?= $errorContent ?>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>