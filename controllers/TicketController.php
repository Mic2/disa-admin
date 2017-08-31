<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Database.php');

class TicketController {
    
    public function GetAllTickets() {
        $db = new Database();
        $ticketsArray = $db->GetAllTicketInformation();
        $db->CloseConnection();
        
        return $ticketsArray;
    }
    
    public function RemoveTicketById($ticketId) {
        $db = new Database();
        $db->RemoveTicket($ticketId);
        $db->CloseConnection();
    }
}

