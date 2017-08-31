<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Database.php');

class EditMovieController {
    
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
}

