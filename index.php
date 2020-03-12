<?php
	session_start();

	require_once("spl_autoloader.php");

	use Distribution\Controller\AccountController;
	use Distribution\Controller\QuoteController;
	use Distribution\Controller\GeneralController;
	use Distribution\Controller\BookController;

	$bookController = new bookController();
	$quoteController  = new QuoteController();
	$accountController =  new AccountController();
	$generalController = new GeneralController();

    if (isset($_GET["action"])) {

        switch ($_GET["action"]) {
      	///////////////////////// General Controller ///////////////////
        	case 'home':
        		$generalController->displayHome();
        		break;

        	case 'redirectContact':
        		$generalController->redirectContact();
        		break;

        	case 'contact':
        		$generalController->sendContact();
        		break;
        ///////////////////////// Quote Controller ///////////////////
        	case 'showQuote':
        		$quoteController->showQuote();
        		break;

        	case 'quote':
        		$quoteController->sendQuote();
        		break;
        	case 'displayQuote':
        		$quoteController->displayQuote();
        		break;

       	///////////////////////// Account Controller ///////////////////
        	case 'account':
        		$accountController->displayAccount();
        		break;
        	case 'signin':
        		$accountController->displaySignin();
        		break;

        	case 'registration':
        		$accountController->setRegistration();
        		break;

        	case 'login':
        		$accountController->setLogin();
        		break;

        	case 'disconnect' :
                $accountController->disconnect();
                break;

            case 'modifyAccount':
                $accountController->modifyAccount();
                break;
        }
    } else {
    	$generalController->displayHome();
    }