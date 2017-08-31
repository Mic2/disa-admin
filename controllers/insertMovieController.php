<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Database.php');

class InsertMovieController {
    
    public function InsertMovieToDB($movie) {
        $db = new Database();
        $db->InsertMovie($movie);
        $db->CloseConnection();
    }
    
    public function CheckShowTimeExist($dateTime) {
        $db = new Database();
        $db->CheckShowTimeExistence($dateTime);
        $db->CloseConnection();
    }
    
    public function InsertShowTime($movieName, $dateTime, $theaterNumber) {
        $db = new Database();
        $db->InsertShowTime($movieName, $dateTime, $theaterNumber);
        $db->CloseConnection();
    }
    
}

