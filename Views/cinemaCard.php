<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Bootstrap responsive movie card | Pure CSS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>
<body>

<div class="container">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-4">
            <div class="card">   
               <div class="card-header">
                  <img class="card-img" src="https://image.tmdb.org/t/p/W500/nBNZadXqJSdt05SHLqgT0HuC5Gm.jpg" alt="Card image">
               </div>  
               <div class="card-body">
                  <h3 class="card-title">Interstellar</h3>
                  <div class="container">
                     <div class="row">
                        <div class="col-4 metadata">
                           <i class="fa fa-star" aria-hidden="true"></i> 
                           <p class=".small">9.5/10</p>
                        </div>
                        <div class="col-8 metadata" class=".small">Adventure. Sci-Fi</div>
                     </div>
                  </div>      
                  <p class="card-text">A team of explorers travel through wormhole in space in an attempt to ensure humanity's survival.</p>
                  <a class="trailer-preview" href="https://youtu.be/ePbKGoIGAXY" target="new">
                     <i class="fa fa-play" aria-hidden="true"></i>  Watch the trailer
                     </a>
               </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>