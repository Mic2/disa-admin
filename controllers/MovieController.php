<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Database.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/models/HtmlMail.php');

class MovieController {
    
    public function InsertMovieToDB($movie) {
        $db = new Database();
        $db->InsertMovie($movie);
        $db->CloseConnection();
        
        $mail = new HtmlMail();
        $mail->SetFromEmail("admin.disa@disa.com");
        $mail->SetFromText("Disa administrations system");
        $mail->SetMessage("Der er oprettet ny film: ".$movie->GetMovieName());
        $mail->SetReplyTo("no-reply@disa.com");
        $mail->SetSubject("ny film oprettet");
        $mail->SetTo("management@disa.com");    
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

