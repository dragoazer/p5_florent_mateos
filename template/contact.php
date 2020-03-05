<?php
	$title = 'Contact';
	$css = "public/css/style.css";
	ob_start(); 
?>		
	<form id="contactForm" method="post">
		<div class="form-group">
			<p>Les valeurs suivies d'un * sont obligatoire</p>
			<label>Nom*</label>
			<input class="form-control" type="text" name="name">
			<label>Prénom*</label>
			<input class="form-control" type="text" name="lastName">
			<label>Adresse mail*</label>
			<input class="form-control" type="text" name="mail">
			<label>Numéro de téléphone</label>
			<input class="form-control" type="text" name="tel">
			<label>Message*</label>
			<input class="form-control" type="text" name="message">
			<button id="sendContact" class="btn btn-secondary signinButton">Envoyer</button>
		</div>
	</form>
	<script src="public/js/contact.js"></script>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>