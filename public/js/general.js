class General {
	isMail(email) 
	{
  		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		return regex.test(email);
	}

	emptyTest (variable) 
	{
		if (variable.length === 0 || /^\s*$/.test(variable) || variable.match(/\d+/g)) {
    		return true;
    	} else {
    		return false;
    	}
	}

	pwdTest (password)
	{
		if (!password.match(/\d+/g) && password.length >= 8 && !password.match(/\p+/g) && !password.match(/\P+/g)) {
			return true;
		} else {
    		return false;
    	}
	}

	requireJsFiles ()
	{
		action = URLSearchParams.get(action);
		switch (action) {
			case 'redirectContact':
				let contact = new Contact();
			break;

			case 'signin':
				let connection = new Connection();
			break;
		}
	}
} 