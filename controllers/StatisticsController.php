<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Database.php');

class StatisticsController {
    
    public function GetAllMovieShowTimesTicketReservations() {
        $db = new Database();
        $statistics = $db->GetAllMovieShowTimesTicketReservations();
        $db->CloseConnection();
        
        return $statistics;
    }
    
}

