class Contact {
	constructor () {
		this.verifError();
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

			$("#errorContact").remove();

			$("input[name='mail']").css("border","");
			$("input[name='lastName']").css("border","");
			$("input[name='message']").css("border","");
			$("input[name='tel']").css("border","");
			$("input[name='name']").css("border","");

			if (!this.isMail(mail)) {
				error = "Le mail n'est pas correct.";
				errorBol = true;
				$("input[name='mail']").css("border","solid 3px red");
			} 

			if (this.emptyTest(lastName)) {
				error = "Vous n'avez pas renseigné votre prénom.";
				errorBol = true;
				$("input[name='lastName']").css("border","solid 3px red");
			}

			if (this.emptyTest(message)) {
				error = "Vous n'avez pas écrit de message.";
				errorBol = true;
				$("input[name='message']").css("border","solid 3px red");
			}

			if (!this.emptyTest(tel)) {
				let parseTel = tel.replace("-","");
				parseTel = parseTel.replace(" ","");
				parseTel = parseInt(parseTel);
				if (!$.isNumeric(parseTel)) {
					error = "Votre numéro est invalide";
					$("input[name='tel']").css("border","solid 3px red");
				}
			}

			if (this.emptyTest(name)) {
				error = "Vous n'avez pas renseigné votre Nom.";
				errorBol = true;
				$("input[name='name']").css("border","solid 3px red");
			}

			if (!errorBol) {
				this.sendMail(name,lastName,mail,tel,message);
			} else {
				$("#contactForm").append('<p id="errorContact">'+error+'</p>');
			}
		});
	}

	sendMail (name,lastName,mail,tel,message)
	{
		$.ajax({
			url: 'http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/index.php?action=contact',
			type: 'POST',
			dataType: '',
			data: {
				name : name,
				lastName : lastName,
				mail : mail,
				tel : tel,
				message : message,
			},
		});
		
	}

	isMail(email) 
	{
  		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		return regex.test(email);
	}

	emptyTest (variable) 
	{
		if (variable.length === 0 || /^\s*$/.test(variable)) {
    		return true;
    	} else {
    		return false;
    	}
	}
}