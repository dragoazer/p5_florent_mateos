<?php
	$title = 'Gestion de compte '.$_SESSION["name"];
	$css = "public/css/style.css";
	ob_start(); 
?>		
	<form>
		<p>
			<label>Mail</label>
			<input class="noInput" type="text" name="">
		</p>
		<p>
			<label>Nom</label>
			<input class="noInput" type="text" name="">
		</p>
		<p>
			<label>Prénom</label>
			<input class="noInput" type="text" name="">
		</p>
		<p>
			<input class="btn btn-secondary signinButton" type="submit" name="" value="changer de mot de passe">
		</p>
	</form>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>