class General {
	constructor ()
	{
		this.requireJsFiles();
	}

	haveDigit (variable)
	{
		if (variable.match(/\d+/g)) {
			return true;
		} else {
			return false;
		}
	}

	isMail (email) 
	{
  		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		return regex.test(email);
	}

	emptyTest (variable) 
	{
		if (variable === NaN || variable === undefined || variable == null || variable.length <= 0 || /^\s*$/.test(variable)) {
    		return true;
    	} else {
    		return false;
    	}
	}

	pwdTest (password)
	{	
		if (password != undefined && password != null) {
			if (password.match(/\d+/g) && password.length >= 8 ) {
				return true;
			} else {
    			return false;
    		}
		} else {
			return false;
		}
	}

	convertDate(dateString){
		let p = dateString.split(/\D/g);
		return [p[2],p[1],p[0] ].join("/");
	}

	requireJsFiles ()
	{
		$(window).on('load', ()=> {
			let diaporama = new Diaporama("#glissement");
			let searchUrl = new URLSearchParams(document.location.search.substring(1));
			let action = searchUrl.get("action");
			switch (action) {
				case 'redirectContact':
					let contact = new Contact();
				break;

				case 'signin':
					let connection = new Connection();
				break;

				case 'displayQuote':
					let quote = new Quote();
				break;
			}		
		});
	}
} 