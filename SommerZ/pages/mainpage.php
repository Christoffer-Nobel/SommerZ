
    <a href="pages/newPost.php" type="submit" name="newPost" value="newPost.php">Lav et nyt opslag</a>

    <?php
    $opslag = getPosts();
    foreach($opslag as $enkeltOpslag){
    ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $enkeltOpslag['overskrift'];?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $enkeltOpslag['fornavn'] . " " . $enkeltOpslag['efternavn'];?></h6>
                <h6 class="card-subtitle mb-3 text-muted"><?php echo $enkeltOpslag['post_tid'];?></h6>
                <p class="card-text"><?php echo $enkeltOpslag['tekst'];?></p>
            </div>
        </div> 
        <?php
    }