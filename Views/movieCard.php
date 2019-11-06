<div class="movie-card">
        <div class="movie-header" style="background:url('')">
            <img src="<?php echo (W342_IMG.$myMovie->getImage())?>" alt="" class="image-div">
		</div>
		<div class="movie-content">
			<div class="movie-content-header">
					<h3 class="movie-title"><?php echo($myMovie->getMovieName())?></h3>
				<div class="imax-logo"></div>
			</div>
			<div class="movie-info">
				<div class="info-section">
					<button class="btn btn-link" type="submit">See Functions</button>
                </div>
                <div class="info-section">
					<button class="btn btn-link" type="submit">See Trailer</button>
				</div>
			</div>
		</div>
</div>