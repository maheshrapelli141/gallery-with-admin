
		<div id="fh5co-main">
			<div class="fh5co-gallery" id='categories-gallery'>

			</div>
			
	
			<div class="fh5co-narrow-content">
      <br>
      <br>
      <br>
				<!-- <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">Services</h2>
				<div class="row">
					<div class="col-md-6">
						<div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
							<div class="fh5co-icon">
								<i class="icon-strategy"></i>
							</div>
							<div class="fh5co-text">
								<h3>Strategy</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
							<div class="fh5co-icon">
								<i class="icon-telescope"></i>
							</div>
							<div class="fh5co-text">
								<h3>Explore</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
							<div class="fh5co-icon">
								<i class="icon-circle-compass"></i>
							</div>
							<div class="fh5co-text">
								<h3>Direction</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="fh5co-feature animate-box" data-animate-effect="fadeInLeft">
							<div class="fh5co-icon">
								<i class="icon-tools-2"></i>
							</div>
							<div class="fh5co-text">
								<h3>Expertise</h3>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
							</div>
						</div>
					</div>

				</div> -->
			</div>


			<div class="fh5co-testimonial" >
				<div class="fh5co-narrow-content">
					<div class="owl-carousel-fullwidth animate-box" data-animate-effect="fadeInLeft">
		            <div class="item">
		            	<!-- <figure>
		            		<img src="/assets/images/testimonial_person2.jpg" alt="Free HTML5 Bootstrap Template">
		            	</figure> -->
		              	<p class="text-center quote">&ldquo;The one stop ,prop shop &rdquo; <cite class="author">&mdash; Jeet Props</cite></p>
		            </div>
		            <div class="item">
		            	<!-- <figure>
		            		<img src="/assets/images/testimonial_person3.jpg" alt="Free HTML5 Bootstrap Template">
		            	</figure> -->
		              	<p class="text-center quote">&ldquo;Setup for films, television,Ad's, events, wedding and many more. &rdquo;
                    <!-- <cite class="author">&mdash; Steve Jobs</cite> -->
                    </p>
		            </div>
		            <!-- <div class="item">
		            	<figure>
		            		<img src="/assets/images/testimonial_person4.jpg" alt="Free HTML5 Bootstrap Template">
		            	</figure>
		              	<p class="text-center quote">&ldquo;I think design would be better if designers were much more skeptical about its applications. If you believe in the potency of your craft, where you choose to dole it out is not something to take lightly. &rdquo;<cite class="author">&mdash; Frank Chimero</cite></p>
		            </div> -->
		          </div>
				</div>
			</div>


			<div class="fh5co-counters" style="background-image: url(/assets/images/hero.jpg);" data-stellar-background-ratio="0.5" id="counter-animate">
				<div class="fh5co-narrow-content animate-box">
					<div class="row" >
						<div class="col-md-6 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="<?= $totalVisits ?>" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Visits</span>
						</div>
						<div class="col-md-6 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="<?= $totalTopics ?>" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Topics</span>
						</div>
						<!-- <div class="col-md-4 text-center">
							<span class="fh5co-counter js-counter" data-from="0" data-to="27232" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Pixels</span>
						</div> -->
					</div>
				</div>
			</div>
		

			<div class="fh5co-narrow-content">
				<div class="row">
					<div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
						<h1 class="fh5co-heading-colored">Get in touch</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
						<!-- <p class="fh5co-lead">Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p> -->
						<p><a href="/contact" class="btn btn-primary">Contact</a></p>
					</div>
					
				</div>
			</div>

	</div>
  <script>
  (async () =>{
    const resp = await $.get('/api/category');
    
    if(resp && resp.data){
      const categories = resp.data;
      let template = '';
      if(categories.length){
        template = categories.map(category => {
          var a = randomColor();

         return `<a class="gallery-item" href="topics/${category.id}">
          <div style="background-image: linear-gradient(to right,${a}, #eee);height:200px;width: 280px">
            <span class="overlay">
              <h2>${category.name}</h2>
              <span>${category.topics} Topics</span>
            </span>
          </div>
        </a>`;
        });
      } else {
        template = '<h2>No Categories</h2>';
      }
      $('#categories-gallery').append(template);
    }
  })();
  </script>
