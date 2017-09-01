<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Database.php');

class StatisticsController {
    
    public function GetAllMovieShowTimesTicketReservations() {
        $db = new Database();
        $statistics = $db->GetAllMovieShowTimesTicketReservations();
        $db->CloseConnection();
        
        return $statistics;
    }
    
    public function GetShowTimeReservationCount() {
        $stats = self::GetAllMovieShowTimesTicketReservations();
        $showTimeArray = array();
        $showTimePrMovieCount = null;
               
        foreach ($stats as $movie => $showTime) {
            $showTimeArray[$movie] = array_unique($showTimeArray);  
            $showTimePrMovieCount[$movie] = array_count_values($showTime);
        }

        return $showTimePrMovieCount;
    }
    
}

