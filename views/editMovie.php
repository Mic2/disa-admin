<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/editMovieController.php');
$editController = new EditMovieController();
$movieDetails = $editController->GetMovieDetails(rawurldecode($_GET['movieName']));

?>
<h1>Edit - <?php echo $movieDetails['movie']->GetMovieName(); ?></h1>
<div id="post-response"></div>
<div class="row">
    <form id="insertMovieForm" method="post" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="movieNameInput">Movie name:</label>
                <input id="movieNameInput" type="text" name="movieName" placeholder="Movie name" class="form-control" value="<?php echo $movieDetails['movie']->GetMovieName(); ?>" />
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
                <input id="showtimeInput" type="datetime" name="showtime[]" class="form-control" placeholder="YYYY-MM-DD HH:MI:SS" />
                <input id="showtimeTheaterInput" type="number" name="theater[]" class="form-control" placeholder="1-10" value="<?php echo $movieDetails['theater']; ?>"/>
            </div>
            <!--These buttons is controlled by JS-->
            <button id="addShowTimeToForm" class="btn btn-success">Add show time</button>
            <div class="form-group">
                <label for="coverImageInput">Select cover image</label>
                <input id="coverImageInput" type="file" name="coverImage" class="" />
            </div>
            <!--Tell the user to leav empty if they wonna keep it.-->
            <div class="form-group">
                <input type="submit" id="InsertMovieButton" name="submitMovieCreation" class="btn btn-primary" />
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
