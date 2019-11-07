<?php include('adminNav.php');?>

<div class="container-fluid">
	<?php foreach($this->moviesList as $myMovie) {
		include('movieCard.php');
	}	
	?>
</div>