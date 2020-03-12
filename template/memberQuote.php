<?php
	$title = 'Gestion de devis '.$_SESSION["name"];
	$css = "public/css/style.css";
	$javascript = "<script src='public/js/quote.js'></script>";
	ob_start(); 
?>

	<h4>Nouveau devis :</h4>
	<form>
		<label>Ville de distribution :</label>
		<input type="text" name="" class="form-control">
		<label>Nombre de prospectus:</label>
		<input type="number" name="" class="form-control">
		<p>
			<label for="scales">Format plus grand que A4</label>
			<input type="checkbox" id="" name="">
		</p>
		<label>précision supplémentaire :</label>
		<input type="text" name="com_member" class="form-control">
		<input type="submit" id='newQuote' class="btn btn-secondary signinButton">
	</form>
	<?php
        if ($_SESSION["connected"] === "admin"):
    ?>
	    <div id="showQuote">
	    	<p>Liste des devis à accepter</p>
	    	<hr>
	    </div>
    <?php 	
		endif; 
        if ($_SESSION["connected"] === "member"):
    ?>
	    <div id="showQuote">
	    	<p>Liste des devis envoyés.</p>
	    	<hr>
	    </div>
    <?php 	
		endif; 
	?>
<?php
	$content = ob_get_clean(); 
	require('template.php'); 
?>