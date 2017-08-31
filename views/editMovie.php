<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/MovieController.php');
$editController = new MovieController();
$movieDetails = $editController->GetMovieDetails(rawurldecode($_GET['movieName']));

?>
<h1>Edit - <?php echo $movieDetails['movie']->GetMovieName(); ?></h1>
<div id="post-response"></div>
<div class="row">
    <form id="editMovieForm" method="post" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="form-group">
                <div id="movieToEdit"></div>
                <input id="movieNameInput" data-movie-to-edit="<?php echo $movieDetails['movie']->GetMovieName(); ?>" type="text" name="movieName" placeholder="Movie name" class="form-control" value="<?php echo $movieDetails['movie']->GetMovieName(); ?>" />
            </div>
            <div class="form-group">
                <label for="movieTypeSelect">Movie type:</label>
                <select id="movieTypeSelect" name="type" class="form-control">
                    <option>premiere</option>
                    <option>normal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="runtimeInput">Movie lengt in minuttes</label>
                <input id="runtimeInput" type="text" name="runtime" placeholder="runtime" class="form-control" value="<?php echo $movieDetails['movie']->GetRunTime(); ?>"/>
            </div>
            <!--Make somekind of foreach here-->
            <div id="multiShowTimeInputWrapper" class="form-group">
                <label for="showtimeInput">ShowTime: YYYY-MM-DD HH:MI:SS - Sal: 1-10</label>
                <?php foreach($movieDetails['time'] as $index => $time) { ?>
                
                    <?php if($index == 0) { ?>
                        <input data-showtime-id="<?php echo $movieDetails['showtimeid'][$index] ?>" type="datetime" name="showtime[]" class="form-control showtimeInput" placeholder="YYYY-MM-DD HH:MI:SS" value="<?php echo $time; ?>" />                
                        <input type="number" name="theater[]" class="form-control showtimeTheaterInput" placeholder="1-10" value="<?php echo $movieDetails['theater'][$index]; ?>" />
                    <?php } else { ?>
                        <span class="input-remove-group" data-showtime-id="<?php echo $movieDetails['showtimeid'][$index] ?>">
                            <input data-showtime-id="<?php echo $movieDetails['showtimeid'][$index] ?>" type="datetime" name="showtime[]" class="form-control showtimeInput" placeholder="YYYY-MM-DD HH:MI:SS" value="<?php echo $time; ?>" />                
                            <input type="number" name="theater[]" class="form-control showtimeTheaterInput" placeholder="1-10" value="<?php echo $movieDetails['theater'][$index]; ?>" />
                            <img src="/Ressources/images/Delete-128.png" />
                        </span>
                    <?php } } ?>              
            </div>
            <!--These buttons is controlled by JS-->
            <button id="addShowTimeToForm" class="btn btn-success">Add show time</button>
            <div class="form-group">
                <label for="coverImageInput">Select cover image</label>
                <input id="coverImageInput" type="file" name="coverImage" class="" />
                <small>If you want to keep the already choosen image then leave this blank.</small>
            </div>
            <!--Tell the user to leav empty if they wonna keep it.-->
            <div class="form-group">
                <input type="submit" id="EditMovieButton" name="submitMovieCreation" class="btn btn-primary" />             
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="form-group">
                <label for="descriptionInput">Movie description:</label>
                <textarea id="descriptionInput" name="description" placeholder="description" rows="15" class="form-control"><?php echo $movieDetails['movie']->GetDescription(); ?></textarea>
            </div>
        </div>

    </form>
</div>
