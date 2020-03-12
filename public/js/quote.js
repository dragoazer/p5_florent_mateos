class Quote {
	cosntructor ()
	{
		this.showQuote(0);
	}

	showQuote (showPage)
	{
		$(window).on('load', ()=> {
			$.ajax({
				url: '',
				type: 'POST',,
				data: {showPage: showPage},
			},
		});
	}
}