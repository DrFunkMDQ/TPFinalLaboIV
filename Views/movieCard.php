<head>
	<link rel="stylesheet" href="<?php echo CSS_PATH . "/movieListStyle.css" ?>" type="text/css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
	<script>
		$('#myModal').on('shown.bs.modal', function() {
			$('#myInput').trigger('focus')
		})
	</script>
</head>

<?php 
	$modalId = preg_replace('/[^A-Za-z0-9\-]/', '', $myMovie->getMovieName());
?>

<div class="movie-card">
	<div class="movie-header" style="background:url('')">
		<img src="<?php echo (W342_IMG . $myMovie->getImage()) ?>" alt="" class="image-div">
	</div>
	<div class="movie-content">
		<div class="movie-content-header">
			<h3 class="movie-title"><?php echo ($myMovie->getMovieName()) ?></h3>
			<div class="imax-logo"></div>
		</div>
		<div class="movie-info">
			<div class="info-section">
				<button class="btn btn-link" type="submit" name="SeeMovieShows" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Show/ShowMovieShowList'" value="<?php echo $myMovie->getIdmovie() ?>">See Functions</button>
			</div>
			<div class="info-section">
				<button class="btn btn-link" type="button" name="SeeMovieTrailer" data-toggle="modal" data-target="#<?php echo $modalId?>Modal">See Trailer</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="<?php echo $modalId?>Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body mb-0 p-0">
				<div class="embed-responsive embed-responsive-16by9 z-depth-1-half" id="yt-player">
					<iframe class="embed-responsive-item" src="<?php echo $myMovie->GetTrailer() ?>" allowscriptaccess="always" id="IFrameVideo"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>