class Contact {
	constructor () {
		this.verifError();
		this.general = new General();
	}

	verifError ()
	{
		$("#sendContact").on("click", (e)=>{
			e.preventDefault();

			let error;
			let errorBol;

			let name = $("input[name='name']").val();
			let lastName = $("input[name='lastName']").val();
			let mail = $("input[name='mail']").val();
			let tel = $("input[name='tel']").val();
			let message = $("input[name='message']").val();

			$(".error").remove();
			$(".valid").remove();
			
			$("input[name='mail']").css("border","");
			$("input[name='lastName']").css("border","");
			$("input[name='message']").css("border","");
			$("input[name='tel']").css("border","");
			$("input[name='name']").css("border","");

			if (!this.general.isMail(mail)) {
				error = "Le mail n'est pas correct.";
				errorBol = true;
				$("input[name='mail']").css("border","solid 3px red");
			} 

			if (this.general.emptyTest(lastName)) {
				error = "Vous n'avez pas renseigné votre prénom.";
				errorBol = true;
				$("input[name='lastName']").css("border","solid 3px red");
			}

			if (this.general.emptyTest(message)) {
				error = "Vous n'avez pas écrit de message.";
				errorBol = true;
				$("input[name='message']").css("border","solid 3px red");
			}

			if (!this.general.emptyTest(tel)) {
				let parseTel = tel.replace("-","");
				parseTel = parseTel.replace(" ","");
				parseTel = parseInt(parseTel);
				if (!$.isNumeric(parseTel)) {
					error = "Votre numéro est invalide";
					$("input[name='tel']").css("border","solid 3px red");
				} 
			} else {
				tel = 1111;
			}

			if (this.general.emptyTest(name)) {
				error = "Vous n'avez pas renseigné votre Nom.";
				errorBol = true;
				$("input[name='name']").css("border","solid 3px red");
			}

			if (!errorBol) {
				this.sendMail(name,lastName,mail,tel,message);
			} else {
				$("#contactForm").append('<p class="error">'+error+'</p>');
			}
		});
	}

	sendMail (name,lastName,mail,tel,message)
	{
		$.ajax({
			url: 'http://localhost/p5_florent_mateos/index.php?action=contact',
			type: 'POST',
			data: {
				name : name,
				lastName : lastName,
				mail : mail,
				tel : tel,
				message : message,
			},
			success :  function () 
			{
				$("#contactForm").append('<p class="valid">Votre message à été envoyé</p>');
			},
			error : function () 
			{
				$("#contactForm").append('<p class="error">Votre message n\'a pue être envoyé</p>');
			},
		});	
	}
}