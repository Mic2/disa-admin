<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Database.php');

class MovieController {
    
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
    
        public function GetAllMovieNames() {
        $db = new Database();
        $viewData = $db->GetAllMovieNames();
        $db->CloseConnection();
        
        return $viewData;
    }
    
    public function GetMovieDetails($movieName) {
        $db = new Database();
        $viewData = $db->GetMovieDetails($movieName);
        $db->CloseConnection();
        
        return $viewData;
    }
    
    public function RemoveShowTimeById($showTimeId) {
        $db = new Database();
        $db->RemoveShowTimeById($showTimeId);
        $db->CloseConnection();
    }
    
    public function EditMovie($movie, $movieNameToEdit) {
        $db = new Database();
        $db->EditMovie($movie, $movieNameToEdit);
        $db->CloseConnection();
    }
    
    public function UpdateShowTimeById($showTimeId, $dateTime, $theaterNumber) {
        $db = new Database();
        $db->UpdateShowTimeById($showTimeId, $dateTime, $theaterNumber);
        $db->CloseConnection();
    }
    
    public function RemoveMovie($movieName){
        $db = new Database();
        $db->RemoveMovie($movieName);
        $db->CloseConnection();
    }
    
}

