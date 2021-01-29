
		<div id="fh5co-main">

			<!-- <div id="map"></div>	 -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3770.163224648827!2d72.89114929955616!3d19.100494020004433!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c870e3d2d671%3A0xc6ec4e32b7a3ad97!2sOYO%20321%20Hotel%20Crescent!5e0!3m2!1sen!2sin!4v1611918750691!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

			<div class="fh5co-more-contact">
				<div class="fh5co-narrow-content">
					<div class="row">
						<div class="col-md-4">
							<div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="fh5co-icon">
									<i class="icon-envelope-o"></i>
								</div>
								<div class="fh5co-text">
									<p><a href="#">jeetprops.com</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="fh5co-icon">
									<i class="icon-map-o"></i>
								</div>
								<div class="fh5co-text">
									<p>A wing Room no 1 & 2 ,
                      Asha Krishna C.H.S,
                      Next to crecent hotel,
                      Sakinaka asalpa link road,
                      Andheri East Mumbai 400072.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="fh5co-feature fh5co-feature-sm animate-box" data-animate-effect="fadeInLeft">
								<div class="fh5co-icon">
									<i class="icon-phone"></i>
								</div>
								<div class="fh5co-text">
									<p><a href="tel://">9930950377</a> (Sandeep)</p>
									<p><a href="tel://">9930955116</a> (Naveen)</p>
                  
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="fh5co-narrow-content animate-box" data-animate-effect="fadeInLeft">
				
				<div class="row">
					<div class="col-md-4">
						<h1>Get In Touch</h1>
					</div>
				</div>
				<form action="/contact" method="POST">
        <?= csrf_field() ?> 
        <?php if (isset($errors) && count($errors)): ?>
            <div class="alert alert-info" role="alert">
                <?= $errors ?>
            </div>
          <?php endif; ?>
        <?php if (session()->get('msg')): ?>
            <div class="alert alert-info" role="alert">
                <?= session()->get('msg') ?>
            </div>
          <?php endif; ?>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Name" name="name">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Email" name="email">
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Phone" name="phone">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
									</div>
                  <?php if (isset($validation)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                  <?php endif; ?>
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-md" value="Send Message">
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
				</form>
			</div>

		</div>