<h1>Testing </h1>
		<div id="fh5co-main">
			<div class="fh5co-gallery" id="topics-gallery">
       
				<!-- <a class="gallery-item" href="single.html">
					<img src="assets/images/work_1.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Nature</h2>
						<span>14 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_2.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>People</h2>
						<span>7 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_3.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Sky</h2>
						<span>22 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_4.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Building</h2>
						<span>28 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_5.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>People 2</h2>
						<span>17 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_6.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Beach</h2>
						<span>34 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_7.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Vegetarian Food</h2>
						<span>10 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_8.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Travel</h2>
						<span>19 Photos</span>
					</span>
				</a>

				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_9.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Family</h2>
						<span>42 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_10.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Food</h2>
						<span>10 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_11.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Gadgets</h2>
						<span>76 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_12.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Cars</h2>
						<span>55 Photos</span>
					</span>
				</a>

				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_13.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Animals</h2>
						<span>47 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_14.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Building 2</h2>
						<span>10 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_15.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Baloon</h2>
						<span>17 Photos</span>
					</span>
				</a>
				<a class="gallery-item" href="single.html">
					<img src="assets/images/work_16.jpg" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
					<span class="overlay">
						<h2>Animals 2</h2>
						<span>22 Photos</span>
					</span>
				</a> -->
			</div>
		

			<div class="fh5co-narrow-content">
				<div class="row">
					<div class="col-md-4 animate-box" data-animate-effect="fadeInLeft">
						<h1 class="fh5co-heading-colored">Get in touch</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
						<p class="fh5co-lead">Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
						<p><a href="#" class="btn btn-primary btn-outline">Learn More</a></p>
					</div>
					
				</div>
			</div>

		</div>
	
<script>
  (() => {
    const topics = <?=json_encode($topics) ?>;
    console.log({topics});
    $topicsGallery = $('#topics-gallery');

    let template = '';
    if(topics.length){
      template = topics.map(topic => {
        const images = topic.images.split(',');
        return` <a class="gallery-item" href="/single/${topic.id}">
					<img src="${images[0]}" alt="${topic.name}">
					<span class="overlay">
						<h2>${topic.name}</h2>
						<span>${images.length} Photos</span>
					</span>
				</a>
      `});
    } else {
      template = 'No Topics';
    }
    $topicsGallery.append(template);
  })();
</script>