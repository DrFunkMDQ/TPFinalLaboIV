<body>
    <div class="container-fluid px-5">
        <div class="pageHeader">
            <div class="pageHeaderTitle">
                <h2 class="cardsTitle">Now Playing Movies</h2>
            </div>
            <div class="pageHeaderFilter">
                <div class="headerLeftFIlter">
                    <div class="btn-group">
                        <form method="post">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Filter by Genre </button>
                            <div class="dropdown-menu">
                                <?php foreach ($this->genreList as $genre) { ?>
                                    <button class="dropdown-item" type="submit" name="<?php echo $genre->getName(); ?>" onclick="this.form.action = '<?php echo FRONT_ROOT ?>Show/ShowListingByGenre'" value="<?php echo $genre->getName(); ?>"><?php echo $genre->getName(); ?></button>
                                    <div class="dropdown-divider"></div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="headerRightFIlter">
                    <div class="btn-group">
                        <form method="post" action="<?php echo FRONT_ROOT ?>Show/ShowListingByDate">
                            <input type="date" class="form-control" Name="startDate" required>
                            <button class="btn btn-primary"> Filter by Date </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <form action="post" class="cardsForm">
                <?php foreach ($movieList as $myMovie) {
                    include('movieCard.php');
                } ?>
            </form>
        </div>
    </div>
</body>