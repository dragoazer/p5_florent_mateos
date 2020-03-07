class General {
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