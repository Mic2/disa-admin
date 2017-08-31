<?php

class Ticket {
    
    private $customerName;
    private $ticketId;
    private $phoneNumber;
    private $showTime;
    private $seatNumber;
    private $movieName;
    private $lineNumber;
    private $theaterNumber;

    
    // Getters 
    public function GetCustomerName() {
        return $this->customerName;
    }
    
    public function GetTicketId() {
        return $this->ticketId;
    }
    
    public function GetPhoneNumber() {
        return $this->phoneNumber;
    }
    
    public function GetShowTime() {
        return $this->showTime;
    }
    
    public function GetSeatNumber() {
        return $this->seatNumber;
    }
    
    public function GetMovieName() {
        return $this->movieName;
    }
    
    public function GetLineNumber() {
        return $this->lineNumber;
    }
    
    public function GetTheaterNumber() {
        return $this->theaterNumber;
    }
    
    // Setters
     public function SetCustomerName($customerName) {
        $this->customerName = $customerName;
    }
    
    public function SetTicketId($ticketId) {
        $this->ticketId = $ticketId;
    }
    
    public function SetPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }
    
    public function SetShowTime($showTime) {
        $this->showTime = $showTime;
    }
    
    public function SetSeatNumber($seatNumber) {
        $this->seatNumber = $seatNumber;
    }
    
    public function SetMovieName($movieName) {
        $this->movieName = $movieName;
    }
    
    public function SetLineNumber($lineNumber) {
        $this->lineNumber = $lineNumber;
    }
    
    public function SetTheaterNumber($theaterNumber) {
        $this->theaterNumber = $theaterNumber;
    }
    
    
}

