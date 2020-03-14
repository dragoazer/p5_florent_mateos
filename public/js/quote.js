class Quote {
	constructor ()
	{	
		this.general = new General;
		this.showQuote(0);
		this.calculPrice();
		this.newQuote();
	}

	calculPrice ()
	{
		$("input[name='number_tract']").on('change', ()=>{

			let tracts = $("input[name='number_tract']").val();
			let priceU = 0.045;
			if (tracts >= 2000 ||  tracts <= 5000) {
				priceU = 0.040;
			}

			if(tracts > 5000) {
				priceU = 0.035;
			}

			let price = Math.round(tracts * priceU);
			$('#price').text( 'Prix HT prévue : '+price+"euros");
		});
	}

	newQuote ()
	{
		$("#newQuote").on("click", (e)=>{
			e.preventDefault();

			let error = false;
			let errorMsg = '';

			$(".valid").remove();
			$(".error").remove();

			$("input[name='city_name']").css("border","");
			$("input[name='number_tract']").css("border","");
			$("input[name='com_member']").css("border","");

			let city_name = $("input[name='city_name']").val();
			let number_tract = $("input[name='number_tract']").val();
			let com_member = $("input[name='com_member']").val();

			if (this.general.haveDigit(city_name) || this.general.emptyTest(city_name)) {
				error = true;
				errorMsg = "Le nom de la ville est erroné.";
				$("input[name='city_name']").css("border","solid 3px red");
			}

			if (!this.general.haveDigit(number_tract) || this.general.emptyTest(number_tract)) {
				error = true;
				errorMsg = "Le nombre de prospectus est invalide.";
				$("input[name='number_tract']").css("border","solid 3px red");
			}

			if (this.general.emptyTest(com_member)) {
				com_member = "Pas de commentaire client."
			}

			if (error === false) {
				this.ajaxQuote(city_name,number_tract,com_member);
				$("#createQuote").append("<p class='valid'>Votre devis à été pris en compte.</p>");
			} else {
				$("#createQuote").append("<p class='error'>"+errorMsg+"</p>");
			}
		});
	}
	ajaxQuote (city_name,number_tract,com_member)
	{
		$.ajax({
			url: 'index.php?action=quote',
			type: 'POST',
			data: {
				city_name: city_name,
				number_tract: number_tract,
				com_member: com_member
			},
			error : function () 
			{
				$("#createQuote").append('<p class="error"Votre devis n\'a pas pu être envoyé</p>');
			},
			complete : ()=>
			{
				this.showQuote(0);
			}
		});	
	}
	showQuote (showPage)
	{
		let that = this;
		$("#showQuote").empty();
		$.ajax({
			url: 'index.php?action=showQuote',
			type: 'GET',
			data: {quotePage: showPage},
			success :  function (response) 
			{	
				let data = jQuery.parseJSON(response);
				$("#showQuote").append("<p>Voici la liste des devis. Actuellement "+data.number+" devis.</p><hr>");
				if (data.status === "member") {
					data.quote.forEach((value)=>{
						if (value.validated === 0) {
							var valid = '<p class="error">Devis non validé</p>';
						} else {
							var valid = '<p class="valid">Devis validé</p>';
						}
						let city_name = "<p> Ville de distribution: "+value.city_name+"</p>";
						let creation_date = "<p>Date de création: "+that.general.convertDate(value.creation_date)+"</p>";

						if ( value.com_admin != null) {
							var com_admin = "<p>"+value.com_admin+"</p>";				
						} else {
							var com_admin = "<p>Pas de message de l'administrateur.</p>";
						}
						let com_member = "<p> Votre commentaire: "+value.com_member+"<br><a class='btn btn-secondary' href='index.php?action=modifyComMember&id="+value.id+"'>Modifier le commentaire</a></p>";
						let number_tract = "<p>Nombre de prospectus: "+value.number_tract+"</p>";
						let price = "<p>Prix du devis: "+value.price+"</p>";
						$("#showQuote").append("<div>"+city_name+creation_date+com_admin+com_member+number_tract+price+valid+"<hr></div>");
					});
				} else {

				}
				let gestionPage = "<div class='page'><div>";
				$("#showQuote").append(gestionPage);
				$("#showQuote").prepend(gestionPage);
				for (let i = 0; i < data.page; i++) {
					let page = i+1;
					if (i === showPage) {
						$(".page").append("<span class='selectPage active "+i+"'>"+page+"</span>");
						console.log("active");
					} else {
						$(".page").append("<span class='selectPage noActive "+i+"'>"+page+"</span>");
						console.log(" no active");
					}
					$("."+i).on('click',  function() {
						console.log(i);
						that.showQuote(i);
					});
				}
				
			},
			error : function () 
			{
				$("#showQuote").append('<p class="error">Aucun devis à afficher.</p>');
			},
			complete : function ()
			{


			},
		});
	}
}