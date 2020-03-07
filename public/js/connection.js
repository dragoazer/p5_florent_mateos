class Connection {
	constructor () {
		this.verifInscription();
		this.verifConnection();
	}

	verifConnection () 
	{
		$("#submitConect").on("click", (e)=>{
			e.preventDefault();

			let email = $("input[name='emailConect']").val();
			let pwd = $("input[name='pwdConect']").val();

			if (!this.general.isMail(email)) {
				error = true;
				errorMsg = "Vous n'avez pas rempli le champs email pour vous connecter";
				$("input[name='emailConect']").css("border","solid 3px red");
			}
			if (this.general.emptyTest(pwd)) {
				error = true;
				errorMsg = "Vous n'avez pas rempli le champs mot de passe.";
				$("input[name='pwdConect']").css("border","solid 3px red");
			}

			if (!$error) {
				$("#connectionForm").submit();
			} else {
				$("#connexion").append("<p>"+error+"</p>");
			}
		});
	}

	verifInscription ()
	{
		$("#submitSignin").on('click', (e)=> {
			e.preventDefault();
			
			let  email= $("input[name='email']").val();
			let first_name = $("input[name='first_name']").val();
			let last_name = $("input[name='last_name']").val();
			let pseudo = $("input[name='pseudo']").val();
			let password = $("input[name=''password]").val();
		});
	}
}