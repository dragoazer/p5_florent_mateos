class Connection {
	constructor () {
		this.verifInscription();
		this.verifConnection();
	}

	verifConnection () 
	{		
		$("#submitConect").on("click", (e)=>{
			e.preventDefault();

			error = false;

			$(".error").remove();

			$("input[name='emailConect']").css("border","");
			$("input[name='pwdConect']").css("border","");

			let email = $("input[name='emailConect']").val();
			let pwd = $("input[name='pwdConect']").val();

			if (!this.general.isMail(email)) {
				error = true;
				errorMsg = "Le courriel est erroné.";
				$("input[name='emailConect']").css("border","solid 3px red");
			}
			if (this.general.emptyTest(pwd)) {
				error = true;
				errorMsg = "Vous n'avez pas rempli le champs mot de passe.";
				$("input[name='pwdConect']").css("border","solid 3px red");
			}

			if (error === false) {
				$("#connectionForm").submit();
			} else {
				$("#connexion").append("<p class='error'>"+error+"</p>");
			}
		});
	}

	verifInscription ()
	{
		$("#submitSignin").on('click', (e)=> {
			e.preventDefault();

			$("input[name='email']").css("border","");
			$("input[name='first_name']").css("border","");
			$("input[name='last_name']").css("border","");
			$("input[name='password']").css("border","");

			$(".error").remove();
			$(".valid").remove();

			let email= $("input[name='email']").val();
			let first_name = $("input[name='first_name']").val();
			let last_name = $("input[name='last_name']").val();
			let password = $("input[name=''password]").val();


			if (!this.general.isMail(email)) {
				error = true;
				errorMsg = "Le champs Email n'est pas valide.";
				$("input[name='email']").css("border","solid 3px red");
			}
			if (this.general.emptyTest(first_name)) {
				error = true;
				errorMsg = "Le champs Email n'est pas valide.";
				$("input[name='first_name']").css("border","solid 3px red");
			}
			if (this.general.emptyTest(last_name)) {
				error = true;
				errorMsg = "Le champs Email n'est pas valide.";
				$("input[name='last_name']").css("border","solid 3px red");
			}
			if (this.general.pdwTest(password)) {
				error = true;
				errorMsg = "Le champs Email n'est pas valide.";
				$("input[name='password']").css("border","solid 3px red");
			}

			if (!error) {
				this.ajaxInscription(email,first_name,last_name,password);
			} else {
				$("#inscription").append("<p class='error'>"+error+"</p>");
			}
		});
	}

	ajaxInscription (email,first_name,last_name,password)
	{
		$.ajax({
			url: 'index.php?action=registration',
			type: 'POST',
			data: {
				email: email,
				first_name: first_name,
				last_name: last_name,
				password: password,
			},
			succes : function() 
			{
				$("#connexion").append("<p class='valid'>Votre inscription à été pris compte veuillez vous connecter.</p>");
				$("#inscription").append("<p class='valid'>Votre inscription à été pris compte veuillez vous connecter.</p>");
			},
			error : function ()
			{
				$("#connexion").append("<p class='error'>Erreur interne, veullez réessayer votre inscription.</p>");
				$("#inscription").append("<p class='error'>Erreur interne, veullez réessayer votre inscription.</p>");
			}
		});
	}
}