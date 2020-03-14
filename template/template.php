<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="initial-scale=1, width=device-width">
        <script src="https://kit.fontawesome.com/aa2b6f73d5.js" crossorigin="anonymous"></script>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title><?= $title ?></title>
        <link href="<?= $css ?>" rel="stylesheet"/> 
        <link href="public/css/baseCss.css" rel="stylesheet" /> 
    </head>
    <body>
        <header>
            <div id="diaporama">
                    <p id="slidePrec"><i class="fas fa-arrow-left"></i></p>
                    <p id="slideSuiv"><i class="fas fa-arrow-right"></i></p>
                <div id="glissement">

                    <div class="contenairSlide">
                        <img src="public/image/moret.jpg">
                        <div class="slideText">
                            <h3>Mathieu Lavaud distribution.</h3>
                            <p>Je suis Mathieu lavaud, auto entrepreneur dans la distribution avec plus de 5 ans d'expériences.</p>
                        </div>
                    </div>

                    <div class="contenairSlide">
                        <img src="public/image/boiteaulettre.jpg">
                        <div class="slideText">
                            <h3>Mathieu Lavaud distribution.</h3>
                            <p>Mon travail consiste à vous faire connaître des riverains et vous apporter des prospects.</p>
                        </div>
                    </div>

                    <div class="contenairSlide">
                        <img src="public/image/marcheprovins.jpg">
                        <div class="slideText">
                            <h3>Mathieu Lavaud distribution.</h3>
                            <p>Ce site à pour bute de vous faire découvrir mes prestations, à me contacter et à établir un devis.</p>
                        </div>
                    </div>

                    <div class="contenairSlide">
                        <img src="public/image/moret.jpg">
                        <div class="slideText">
                            <h3>Mathieu Lavaud distribution.</h3>
                            <p>Je suis Mathieu lavaud, auto entrepreneur dans la distribution avec plus de 5 ans d'expérience.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="control">
                <button id="prec"><i class="fas fa-backward"></i></button>
                <button id="onoff"><i class="fas fa-pause"></i></button>
                <button id="suiv"><i class="fas fa-forward"></i></button>
            </div>
            <nav id="menu">
                <?php
                    //if (!isset($_GET["action"]) OR $_GET["action"] != "home"):
                ?>
                    <a class="menuButton" href='index.php?action=home'>Accueil</a>
                <?php //endif; ?>
                    <a class="menuButton" href="index.php?action=redirectContact">Contact</a>
                <?php
                    //if(isset($_SESSION["pseudo"]) AND !empty($_SESSION["pseudo"])):
                ?>
                    <a class="menuButton" href="index.php?action=account">Gestion de compte</a>
                    <a class="menuButton" href="index.php?action=displayQuote">Gestion de devis</a>
                    <a class="menuButton" href="index.php?action=disconnect">Déconnexion</a>
                <?php //else: ?>
                    <a class="menuButton" href="index.php?action=signin">Connexion</a>
                <?php //endif; ?>
            </nav>
        </header>
        <div id="content">
            <?= $content ?>
        </div>
        <footer id="footer">
            
        </footer>
    </body>
    <!-- general script router of js class, charge him on first-->
    <script src="public/js/general.js"></script>
    <script src="public/js/diaporama.js"></script>
    <!-- js initialized in controller -->
    <?= $javascript ?? "" ?>
    <!-- js.js is class loader, charge him on last -->
    <script src="public/js/js.js"></script>
</html>