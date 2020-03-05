class Diaporama {
	
	constructor (idGlissement) {
		this.pause = false; // lié au bouton de pause
		this.decale = 0; // nombre d'image de diaporama qui ont défilé
		this.estActif = false; // variable qui empêche de spamer les actions sur le diaporama
		this.nmbDecale = $(".contenairSlide").length-1; // le nombre d'image dans le diaporama
		this.idGlissement = idGlissement;
		this.lancement();
		this.precedent();
		this.suivant();
		this.onOff();
	}

	//////////////////////////////FONCTION DIAPORAMA//////////////////// permet le défilement automatique
	diaporama() {
		if (!this.estActif && !this.pause) {

			// si decale est supérieur ou égale au nombre d'image on décale le block #glissement à left 0 ce qui correspond à la permière image
			if(this.decale >= this.nmbDecale){
				this.decale = 0;
				$(this.idGlissement).css("left","0");
			}

			// si on est pas en pause on applique une annimation de 300 ms qui déplace le block #glissement de 100% à gauche
			this.estActif = true;
			this.decale++;
			$( this.idGlissement ).animate({
				left: "-=100%",
			}, 300, () =>{
				this.estActif = false;
			});	
		}
	}
	//////////////////////////////LANCEMENT DU DIAPORAMA////////////////////
	lancement () {
		$(document).ready(setInterval( ()=>{
			this.diaporama()
		}, 5000));
	}
	
	//////////////////////////////BOUTON PRECEDENT//////////////////// permet de défilé l'image
	precedent () {
		// précédent sur la flèche gauche
		$(document).on( "keydown", (e)=> {
			if (e.keyCode === 37 || e.which ===37) {// on vérifie le code de la touche presser
				if (!this.estActif) {

				if(this.decale <= 0){ // on vérifie que l'on est pas à la première image.
					this.decale = this.nmbDecale; // on décale à la dernière image
					$(this.idGlissement).css({left : "-300%"});
				}

				this.estActif = true; // on bloque les autres actions possible

				$( this.idGlissement ).animate({
    				left: "+=100%",
  				}, 300, ()=>{
  					this.estActif = false;
  				});
  				this.decale--; // on incrémente decale pour prévenir qu'on est passer à une autre image
				}
			}
		});

		// précédent sur le bouton
		$("#prec, #slidePrec").on('click', ()=>{
			//si aucune action est en cours
			if (!this.estActif) {

				if(this.decale <= 0){ // on vérifie que l'on est pas à la première image.
					this.decale = this.nmbDecale; // on décale à la dernière image
					$(this.idGlissement).css({left : "-300%"});
				}

				this.estActif = true; // on bloque les autres actions possible

				$( this.idGlissement ).animate({
    				left: "+=100%",
  				}, 300, ()=>{
  					this.estActif = false;
  				});
  				this.decale--; // on incrémente decale pour prévenir qu'on est passer à une autre image
			}
		});
	}

	suivant () {
		// suivant sur la flèche droite
		$(document).on( "keydown", (e)=> {
			if (e.keyCode === 39 || e.which === 39) {// on vérifie le code de la touche presser
				if (!this.estActif) {
					if(this.decale >= this.nmbDecale){ // on vérifie que l'on est pas à la dernière image
						this.decale=0;
						$(this.idGlissement).css("left","0");
					}

					this.estActif = true; // on bloque les autres actions possible

					$( this.idGlissement ).animate({
    					left: "-=100%",
  					}, 300, ()	=>{
  						this.estActif = false;
  					});
  					this.decale++; // on incrémente decale pour prévenir qu'on est passer à une autre image
				}
			}
		});

		// effectue un left -100% pour passer au diaporama de droite
		$("#suiv, #slideSuiv").on('click', ()=>{
			if (!this.estActif) {
				if(this.decale >= this.nmbDecale){ // on vérifie que l'on est pas à la dernière image
					this.decale=0;
					$(this.idGlissement).css("left","0");
				}

				this.estActif = true; // on bloque les autres actions possible

				$( this.idGlissement ).animate({
    				left: "-=100%",
  				}, 300, ()	=>{
  					this.estActif = false;
  				});
  				this.decale++; // on incrémente decale pour prévenir qu'on est passer à une autre image
			}
		});
	}
//////////////////////////////ON OFF////////////////////
onOff () {
	// fonction arrêt/marche du diaporama
	$("#onoff").on('click', ()=>{
		if (!this.pause) {
			this.pause = true;
			$("#onoff i").removeClass("fa-pause").addClass('fa-play-circle');
		}

		else {
			this.pause = false;
			$("#onoff i").addClass("fa-pause").removeClass('fa-play-circle');
		}
	});
}




}//FIN de la classe Diaporama