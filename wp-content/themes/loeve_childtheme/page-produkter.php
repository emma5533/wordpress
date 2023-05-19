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
					<button id="produktknap" type="button" >læg i kurv</button>
					<h3 class="indeholder"></h3>
					<hr id="produkt_hr">
				</article>
				
			</template>


			<script>
				console.log("hej");

				let produkter;
				const url = "https://emmaiguldbergsgade.dk/4sem_eksamen/loevebotanical/wp-json/wp/v2/produkt";

				async function getJson() {
					let response = await fetch(url);
					produkter = await response.json();
					visProdukter();
				}

				function visProdukter() {
					console.log(produkter);
					let produktLoop = document.querySelector("#allproducts");
					let produktTemplate = document.querySelector(".produkt_template")
					produkter.forEach(produkt=> {
						const clone = produktTemplate.cloneNode(true).content;
						clone.querySelector("h2").textContent = produkt.title.rendered;
						clone.querySelector("img").src = produkt.produktbillede.guid;
						clone.querySelector(".bsk").textContent = produkt.produktbsk;
						clone.querySelector(".pris").textContent = produkt.pris + "kr.";
						clone.querySelector(".indeholder").textContent = produkt.title.rendered + " indeholder:";
					
					produktLoop.appendChild(clone);
				})
				}

				getJson();



			</script>


		
<?php
get_footer();
