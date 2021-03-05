<div id="fh5co-main">
			<div class="fh5co-gallery" id="topics-gallery">
       
			
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
  (async () => {
    try{
      const url = new URLSearchParams(window.location.search);
      const query = url.get('q');
      const resp = await fetch(`/api/topic/search/${query}`).then(res => res.json());
      console.log(resp);
      const topics = resp.data;
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
    }catch(e){
      console.log(e);
    }
  })();
</script>