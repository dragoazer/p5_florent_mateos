<?php
	$title = 'Gestion de devis '.$_SESSION["name"];
	$css = "public/css/style.css";
	$javascript = "<script src='public/js/quote.js'></script>";
	ob_start(); 
?>

	<h4>Nouveau devis :</h4>
	<form id="createQuote">
		<label>Ville de distribution :</label>
		<input type="text" name="city_name" class="form-control">
		<label>Nombre de prospectus:</label>
		<input type="number" name="number_tract" class="form-control">
		<label>précision supplémentaire :</label>
		<input type="text" name="com_member" class="form-control">
		<p id="price">Prix HT prévue : </p>
		<input type="submit" id='newQuote' class="btn btn-secondary signinButton">
	</form>
	<hr>
	<?php
        if ($_SESSION["connected"] === "admin"):
    ?>
    	<h4>Liste des devis à accepter</h4>
	    <div id="showQuote">
	    </div>
    <?php 	
		endif; 
        if ($_SESSION["connected"] === "member"):
    ?>
    	<h4>Liste des devis envoyés.</h4>
	    <div id="showQuote">
	    </div>
    <?php 	
		endif; 
	?>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>