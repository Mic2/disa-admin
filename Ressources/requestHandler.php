<?php
/*This will route requests to the appropriate controllers and classes */

/* Getting all of the controllers */
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/insertMovieController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Movie.php');

$controller = $_POST['controller'];
$methodToCall = $_POST['methodName'];

/*Check if we have the insertMovieController*/
if($controller == "insertMovie") {
    
    if($methodToCall == "InsertMovieToDB") {
        
        // Instanciate the Controller
        $imc = new insertMovieController();
        
        // Instanciate the Movie
        $movie = new Movie();
        $movie->SetMovieName($_POST['movieName']);
        $movie->SetRunTime($_POST['runtime']);
        $movie->SetType($_POST['type']);
        $movie->SetDescription($_POST['description']);
        $movie->SetConverImage($_FILES["coverImage"]["name"]);

        // Inserting the movie to db
        $imc->InsertMovieToDB($movie, $showTimes);
        
        // Uploading the coverImage
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["coverImage"]["name"]);
        $uploadOk = 1;

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["coverImage"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["coverImage"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        // Inserting showtime if it doest exit.
        // If not then we insert it.
        $theaterNumber = $_POST['theater'];
        $showTimes = $_POST['showtime'];
        $count = 0;
        foreach ($showTimes as $dateTime) {
            $imc->CheckShowTimeExist($dateTime);
            $imc->InsertShowTime($movie->GetMovieName(), $dateTime, $theaterNumber[$count]);
            $count = $count + 1;
        }

        
    }
}

