class MemberAccount {
	constructor ()
	{
		this.modifyAccount();
		this.general = new General;
	}

	modifyAccount ()
	{
		$("#submitModifyAccount").on('click', (e)=>{
			e.preventDefault();

			let error = false;
			let errorMsg = '';

			$("input[name='email']").css("border","");
			$("input[name='first_name']").css("border","");
			$("input[name='last_name']").css("border","");
			$("input[name='password']").css("border","");

			$(".error").remove();
			$(".valid").remove();

			let email= $("input[name='email']").val();
			let first_name = $("input[name='first_name']").val();
			let last_name = $("input[name='last_name']").val();
			let password = $("input[name='password']").val();

			if (!this.general.isMail(email)) {
				error = true;
				errorMsg = "Le champs Email n'est pas valide.";
				$("input[name='email']").css("border","solid 3px red");
			}
			if (this.general.emptyTest(first_name)) {
				error = true;
				errorMsg = "Le champs nom est vide.";
				$("input[name='first_name']").css("border","solid 3px red");
			}
			if (this.general.emptyTest(last_name)) {
				error = true;
				errorMsg = "e champs prénom est vide..";
				$("input[name='last_name']").css("border","solid 3px red");
			}
			if (password != undefined) {
				if (!this.general.pwdTest(password)) {
					error = true;
					errorMsg = "Le champs mot de passe ne compte pas huit caractères une majuscule et un chiffre.";
					$("input[name='pwd']").css("border","solid 3px red");
				}
			}

			if (!error) {
				$("#modifyAccount").submit();
			} else {
				$("#modifyAccount").append("<p class='error'>"+errorMsg+"</p>");
			}
		});
	}
}
