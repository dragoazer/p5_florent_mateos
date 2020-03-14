<?php
	$title = 'Gestion de compte '.$_SESSION["name"];
	$css = "public/css/style.css";
	ob_start(); 
?>
	<h4>Information de compte.</h4>
	<p><?=$account->email()?></p>
	<p><?=$account->first_name()?></p>
	<p><?=$account->last_name()?></p>
	<h4>Modification des données de compte.</h4>
	<form id="modifyAccount" action="index.php?action=modifyAccount" method="POST" enctype="multipart/form-data">
		<p>
			<p>Image de profil actuelle :</p>
			<img id="memberImage" src="<?= $account->profile_picture() ?>">
			<p><label>Image de profile (png et jpg accepté)</label></p>
			<input type="file" name="profile_picture" accept="image/png, image/jpeg" class="form-control-file">

		</p>
		<p><input type="submit" class="btn btn-secondary signinButton" id="submitModifyAccount" value="Modifier"></p>
	</form>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>