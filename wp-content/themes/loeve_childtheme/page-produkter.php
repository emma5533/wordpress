<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="produktside" class="site-main">
			<h1>alle vores produkter</h1>
			<article id="allproducts"></article>

			</main><!-- #main -->
	</div><!-- #primary -->


			<template class="produkt_template">
				<article class="produkt_loop">
					<img src="" alt="">
					<h2></h2>
					<p class="bsk"></p>
					<p class="pris"></p>
					<p class="multi"></p>
					<div id="tabcontainer">
						<div id="tabs">
							<button class="tab knap1"></button>
							<button class="tab knap2"></button>
							<button class="tab knap3"></button>
						</div>
							<div class="tabcontent hide" id="content-0">
								<p id="mulighed1">toneren tilbyder fugt til din rutine. </p>
							</div>
							<div class="tabcontent hide" id="content-1">
								<p id="mulighed2">mist kan fugte ansigtet og give glød.</p>
							</div>
							<div class="tabcontent hide" id="content-2">
								<p id="mulighed3">serum fornyer hudens energi.</p>
							</div>
					</div>
					<button id="produktknap" type="button" >læg i kurv</button>
					<h3 class="indeholder"></h3>
					<hr id="produkt_hr">
				</article>
				
			</template>


			<script>
				//Tjekker om der er kontakt til consolloggen. 
				console.log("hej");

				//Sætter to konstanter til senere brug
				let produkter;
				const url = "https://emmaiguldbergsgade.dk/4sem_eksamen/loevebotanical/wp-json/wp/v2/produkt";

				//asynkron funktion der henter json data, og sætter visProdukter funktionen igang
				async function getJson() {
					let response = await fetch(url);
					produkter = await response.json();
					visProdukter();

					//I denne funktion sættes også eventlisteners på knapperne, og openTab funktionen kaldes
					const tabs = document.querySelectorAll(".tab")
					tabs.forEach((tab, index)=>{
  					tab.addEventListener("click", ()=>{openTab(index)})
				})
				}

				//funktionen som viser produkterne og sætter dem ind i template fra html, og kloner indholdet gang på gang
				function visProdukter() {
					console.log(produkter);
					let produktLoop = document.querySelector("#allproducts");
					let produktTemplate = document.querySelector(".produkt_template")
					//ForEach loopet sørger for, at hver produkt bliver klonet på samme vis
					produkter.forEach(produkt=> {
						const clone = produktTemplate.cloneNode(true).content;
						clone.querySelector("h2").textContent = produkt.title.rendered;
						clone.querySelector("img").src = produkt.produktbillede.guid;
						clone.querySelector(".bsk").textContent = produkt.produktbsk;
						clone.querySelector(".multi").textContent = produkt.title.rendered + " er multifunktionel. Brug den som:"
						clone.querySelector(".knap1").textContent = produkt.funktion1;
						clone.querySelector(".knap2").textContent = produkt.funktion2;
						clone.querySelector(".knap3").textContent = produkt.funktion3;
						clone.querySelector("#mulighed1").textContent = produkt.mulighed1;
						clone.querySelector("#mulighed2").textContent = produkt.mulighed2;
						clone.querySelector("#mulighed3").textContent = produkt.mulighed3;
						clone.querySelector(".pris").textContent = produkt.pris + "kr.";
						clone.querySelector(".indeholder").textContent = produkt.title.rendered + " indeholder:";
					//Sætter klonerne ind i templatet når de er "udfyldt"
					produktLoop.appendChild(clone);
				})
				}

				//Funktionen som åbner vores tabs
				function openTab(tabIndex) {
  				console.log(tabIndex);
 				 //identificerer alle tabs' indhold, da de alle har klassen tabcontent
 				 let tabContents = document.querySelectorAll(".tabcontent");

				 //De er gemt på forhånd, men denne tjekker om indextallet =dén tab der er trykket på. De ligger i et array og har værdierne 0-2
 				 // Hvis indextallet stemmer med dén tab, der er trykket på vises den.
 				 tabContents.forEach(function (content, index) {
   				 if (index === tabIndex) {
     			 content.style.display = 'block';
				 //Ellers gemmer den tabbens indhold. Altså hvis man ikke har trykket på den, gemmes indholdet.
  				  } else {
  			    content.style.display = 'none';
 			   			}
 					 });
				}

				getJson();



			</script>


		
<?php
get_footer();
