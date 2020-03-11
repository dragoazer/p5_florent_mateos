<?php
	$title = 'Gestion de compte '.$_SESSION["name"];
	$css = "public/css/style.css";
	ob_start(); 
?>	
	<h4>Modification des données de compte</h4>
	<form id="modifyAccount" action="index.php?action=modifyAccount" method="POST">
		<p>
			<label>Mail</label>
			<input class="form-control" type="text" name="email" value="<?= $account->email()?>">
		</p>
		<p>
			<label>Nom</label>
			<input class="form-control" type="text" name="first_name" value="<?= $account->first_name() ?>">
		</p>
		<p>
			<label>Prénom</label>
			<input class="form-control" type="text" name="last_name" value="<?= $account->last_name() ?>">
		</p>
		<p>
			<label>Mot de passe</label>
			<input class="form-control" type="text" name="" placeholder="Nouveau mot de passe.">
		</p>
		<p>
			<p>Image actuelle :</p>
			<img src="<?= $account->profile_picture() ?>">
			<p><label>Image de profile (png et jpg accepté)</label></p>
			<input type="file" name="profile_picture" accept="image/png, image/jpeg" class="form-control-file">

		</p>
		<p><input type="submit" class="btn btn-secondary signinButton" id="submitModifyAccount" value="Modifier"></p>
	</form>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>