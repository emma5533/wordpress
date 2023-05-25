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
		<main id="eventside" class="site-main">
			<h1>events</h1>
			<article id="allevents"></article>
		</main><!-- #main -->
	</div><!-- #primary -->

	<template class="event_template">
		<article class="event_loop">
			<div class="dag">
			<h3 class="dato"></h3>
			<h3 class="maaned"></h3>
			</div>
			<img src="" alt="">
			<h2></h2>
			<p></p>
			<button id="eventknap" type="button">tilmeld dig her</button>
			<hr id="event_hr">
		</article>
	</template>

		<script>
			console.log("hej");
			let events;
			const url = "https://emmaiguldbergsgade.dk/4sem_eksamen/loevebotanical/wp-json/wp/v2/event";

			async function getJson() {
					let response = await fetch(url);
					events = await response.json();
					visEvents();
				}

			function visEvents(){
				console.log(events);
				let eventLoop = document.querySelector("#allevents");
				let eventTemplate = document.querySelector(".event_template");

				events.forEach(event => {
					const clone = eventTemplate.cloneNode(true).content;
					clone.querySelector(".dato").textContent = event.dato;
					clone.querySelector(".maaned").textContent = event.maaned;
					clone.querySelector("img").src = event.eventbillede.guid;
					clone.querySelector("h2").textContent = event.title.rendered;
					clone.querySelector("p").textContent = event.eventbsk;
					
					eventLoop.appendChild(clone);
				});

			
				
			}


			getJson();



		</script>


		

<?php
get_footer();
