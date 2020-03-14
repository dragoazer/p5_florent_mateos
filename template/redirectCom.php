<?php
	$title = 'Modification de commentaire';
	$css = "public/css/style.css";
	ob_start(); 
?>
	<form method="POST" action="<?=$_SESSION["connected"] === "admin" ? "index.php?action=modifyComAdmin" : "index.php?action=modifyCom&id=".$_GET["id"] ?>">
		<label>Nouveau commentaire : </label>
		<input type="text" name="newCom" class="form-control">
		<input type="submit" class="btn btn-secondary signinButton" value="Envoyer le nouveau commentaire">
	</form>

<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>