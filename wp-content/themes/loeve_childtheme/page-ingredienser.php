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
		<main id="igside" class="site-main">
			<h1>produkternes <br> ingredienser</h1>
			<div id="filtrering"><button data-ingrediens="alle">se alle</button></div>
			<article id="allingredients">
			</article>
			</main><!-- #main -->
	</div><!-- #primary -->

		<template class="ingrediens_template">
			<article class="ingrediens_loop">
				<img src="" alt="">
				<h2></h2>
				<p class="igbsk"></p>
				<h3 class="iprodukt"></h3>
			</article>
		</template>	

			<script>
				console.log("hej");

				let	ingredienser;
				let categories;
				let filterIngrediens = "alle";
				const url = "https://emmaiguldbergsgade.dk/4sem_eksamen/loevebotanical/wp-json/wp/v2/ingrediens";
				const caturl = "https://emmaiguldbergsgade.dk/4sem_eksamen/loevebotanical/wp-json/wp/v2/categories";

				async function getJson() {
					let response = await fetch(url);
					let catresponse = await fetch(caturl);
					ingredienser = await response.json();
					categories = await catresponse.json();
					console.log(categories);
					visIngredienser();
					lavKnapper();
				}

				function lavKnapper(){
					categories.forEach(cat =>{
						document.querySelector("#filtrering").innerHTML += `<button class="filter" data-ingrediens="${cat.id}">${cat.slug}</button>`
					})
					addEventListenerToKnap();

				}

				function addEventListenerToKnap(){
					document.querySelectorAll("#filtrering button").forEach(knap =>{
						knap.addEventListener("click",lavFiltrering);
					})

				}


				function lavFiltrering	(){
					filterIngrediens = this.dataset.ingrediens;
					console.log(filterIngrediens);
					visIngredienser();

				}


				function visIngredienser (){
					console.log(ingredienser); 
					let ingrediensLoop = document.querySelector("#allingredients");
					let ingrediensTemplate = document.querySelector(".ingrediens_template");
					ingrediensLoop.innerHTML = "";
					ingredienser.forEach(ingrediens=>{
						if(filterIngrediens == "alle"||ingrediens.categories.includes(parseInt(filterIngrediens))){
						const clone = ingrediensTemplate.cloneNode(true).content;
						clone.querySelector("h2").textContent = ingrediens.title.rendered;
						clone.querySelector("img").src = ingrediens.ingrediensbillede.guid;
						clone.querySelector(".igbsk").textContent = ingrediens.ingrediensbsk;
						clone.querySelector(".iprodukt").textContent = ingrediens.title.rendered + " indgår i vores " + ingrediens.iprodukt;

						ingrediensLoop.appendChild(clone);}
					
					})



				}

				getJson();




			</script>

		

<?php
get_footer();
