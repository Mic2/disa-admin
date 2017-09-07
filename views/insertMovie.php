<?php
session_start();
if(!isset($_SESSION['membership']) || $_SESSION['membership'] != "Management") {
    require_once('ldap.php');
    if(empty($_SESSION['membership']) || $_SESSION['membership'] != "Management") {
    	header('Location: 403.php');
    }
}
?>
<h1>Insert Movie</h1>
<div id="post-response"></div>
<div class="row">
    <form id="insertMovieForm" method="post" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="movieNameInput">Movie name:</label>
                <input id="movieNameInput" type="text" name="movieName" placeholder="Movie name" class="form-control" />
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
                <input id="runtimeInput" type="text" name="runtime" placeholder="runtime" class="form-control" />
            </div>
            <div id="multiShowTimeInputWrapper" class="form-group">
                <label for="showtimeInput">ShowTime: YYYY-MM-DD HH:MI:SS - Sal: 1-10</label>
                <input type="datetime" name="showtime[]" class="form-control showtimeInput" placeholder="YYYY-MM-DD HH:MI:SS" />
                <input type="number" name="theater[]" class="form-control showtimeTheaterInput" placeholder="1-10"/>
            </div>
            <!--These buttons is controlled by JS-->
            <button id="addShowTimeToForm" class="btn btn-success">Add show time</button>
            <div class="form-group">
                <label for="coverImageInput">Select cover image</label>
                <input id="coverImageInput" type="file" name="coverImage" class="" />
            </div>
            <div class="form-group">
                <input type="submit" id="InsertMovieButton" name="submitMovieCreation" class="btn btn-primary" />
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="form-group">
                <label for="descriptionInput">Movie description:</label>
                <textarea id="descriptionInput" name="description" placeholder="description" rows="15" class="form-control"></textarea>
            </div>
        </div>

    </form>
</div>
