<?php
            
            $json = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=3a826f6a0e7fb42cdf899bbba2e08621");
            $result = json_decode($json, true);
            $restult2 = $result['results'];
            //file_put_contents('../Data/Movies.json', $restult2);
     
            var_dump($restult2);


?>
