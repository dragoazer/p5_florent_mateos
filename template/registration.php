<?php
	$title = 'Inscription / Connexion';
	$css = "public/css/style.css";
	$javascript = "<script src='public/js/connection.js'></script>";
	ob_start(); 
?>
	<div id="contactForm">
		<div id="signin">
			<div id="connexion">
				<h3>Connexion</h3>
				<form class="form-group" action="index.php?action=login" method="post" id="connectionForm">
					<label for="emailConect">Email</label>
					<input type="text" name="emailConect" class="form-control">
					<label for="pwdConect">Mot de passe</label>
					<input type="password" name="pwdConect" class="form-control">
					<button class="btn btn-secondary signinButton" id="submitConect">Connexion</button>
				</form>
			</div>
			<?= $error??"" ?>
		</div>

		<hr id="signinSeparator">

		<div id="signin">
			<div id="inscription">
				<h3>Inscription</h3>
				<form class="form-group" method="post" id="inscriptionForm">
					<label for="pwdConect">Email</label>
					<input type="text" name="email" class="form-control">
					<label for="pwdConect">Nom</label>
					<input type="text" name="first_name" class="form-control">
					<label for="pwdConect">Prénom</label>
					<input type="text" name="last_name" class="form-control">
					<label for="pwdConect">Mot de passe</label>
					<input type="password" name="password" class="form-control">
					<p><input type="submit" class="btn btn-secondary signinButton" id="submitSignin" value="Inscription"></p>
				</form>
			</div>
		</div>
	</div>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>