<?php
/*This will route requests to the appropriate controllers and classes */

/* Getting all of the controllers */
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/MovieController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/controllers/TicketController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Movie.php');

$controller = $_POST['controller'];
$methodToCall = $_POST['methodName'];

/*Check if we have the insertMovieController*/
if($controller == "MovieController") {
    
if($methodToCall == "InsertMovieToDB") {

    // Instanciate the Controller
    $imc = new MovieController();

    // Instanciate the Movie
    $movie = new Movie();
    $movie->SetMovieName($_POST['movieName']);
    $movie->SetRunTime($_POST['runtime']);
    $movie->SetType($_POST['type']);
    $movie->SetDescription($_POST['description']);
    $movie->SetConverImage("/images/".$_FILES["coverImage"]["name"]);

    // Inserting the movie to db
    $imc->InsertMovieToDB($movie, $showTimes);

    // Uploading the coverImage
    $target_dir = "/var/www/disa/disa/bin/Release/PublishOutput/wwwroot/images/";
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
 
if($methodToCall == "RemoveShowTimeById") {

// Instanciate the Controller
    $emc = new MovieController();
    $emc->RemoveShowTimeById($_POST['showTimeId']);
}

if($methodToCall == "EditMovie") {

    // Instanciate the Controller
    $emc = new MovieController();

    // Instanciate the Movie
    $movie = new Movie();
    $movie->SetMovieName($_POST['movieName']);
    $movie->SetRunTime($_POST['runtime']);
    $movie->SetType($_POST['type']);
    $movie->SetDescription($_POST['description']);
    if(!empty($_FILES["coverImage"]["name"])) {
        $movie->SetConverImage("/images/".$_FILES["coverImage"]["name"]);
    } else {
        $movie->SetConverImage("dont-update");
    }
      // Inserting the movie to db
    $emc->EditMovie($movie, $_POST['movieToEdit']);

    if($movie->GetCoverImage() != 'dont-update') {
        // Uploading the coverImage
        $target_dir = "/var/www/disa/disa/bin/Release/PublishOutput/wwwroot/images/";
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
    }
    // Inserting showtime if it doest exit.
    // If not then we insert it.
    $theaterNumber = $_POST['theater'];
    $showTimes = $_POST['showtime'];
    $showTimesIds = json_decode($_POST['showTimeIds']);
    $count = 0;
    
    foreach ($showTimesIds as $id) {
        $emc->CheckShowTimeExist($showTimes[$count]);
        // if the user has inserted new showtimes we will add them, otherwise we update them.
        if($id == 'not-set') {
           $emc->InsertShowTime($movie->GetMovieName(), $showTimes[$count], $theaterNumber[$count]); 
        }  
        else {
            $emc->UpdateShowTimeById($id, $showTimes[$count], $theaterNumber[$count]);
        }
        $count = $count + 1;
    }  
}

if($methodToCall == "RemoveMovie") {
    $emc = new MovieController();
    $emc->RemoveMovie($_POST['movieName']);
}

/*Movie controller end*/
}

if($controller == "TicketController") {
    
    $tc = new TicketController();
    
    if($methodToCall == "RemoveTicketById") { 
        $tc->RemoveTicketById($_POST['ticketId']);
    }
    
    if($methodToCall == "EditCustomer") { 
        $tc->EditCustomer($_POST['customerPhoneNumber'], $_POST['customerName']);
    }

}

