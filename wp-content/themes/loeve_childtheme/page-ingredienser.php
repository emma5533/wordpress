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
				const url = "https://emmaiguldbergsgade.dk/4sem_eksamen/loevebotanical/wp-json/wp/v2/ingrediens";

				async function getJson() {
					let response = await fetch(url);
					ingredienser = await response.json();
					visIngredienser();
				}

				function visIngredienser (){
					console.log(ingredienser); 
					let ingrediensLoop = document.querySelector("#allingredients");
					let ingrediensTemplate = document.querySelector(".ingrediens_template");
					ingredienser.forEach(ingrediens=>{
						const clone = ingrediensTemplate.cloneNode(true).content;
						clone.querySelector("h2").textContent = ingrediens.title.rendered;
						clone.querySelector(".igbsk").textContent = ingrediens.ingrediensbsk;
						clone.querySelector(".iprodukt").textContent = ingrediens.title.rendered + " indgår i vores " + ingrediens.iprodukt;

						ingrediensLoop.appendChild(clone);
					})



				}

				getJson();




			</script>

		

<?php
get_footer();
