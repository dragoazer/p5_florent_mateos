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
			
			$("input[name='password']").css("border","");

			$(".error").remove();
			$(".valid").remove();

			let password = $("input[name='password']").val();


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
