<?php

class Movie {
    
    private $movieName;
    private $runTime;
    private $type;
    private $description;
    private $converImage;
    
    /*Getters*/
    public function GetMovieName() { return $this->movieName; }
    public function GetRunTime() { return $this->runTime; }
    public function GetType() { return $this->type; }
    public function GetDescription() { return $this->description; }
    public function GetCoverImage() { return $this->converImage; }
    
    /*Setters*/
    public function SetMovieName($movieName) { $this->movieName = $movieName; }
    public function SetRunTime($runTime) { $this->runTime = $runTime; }
    public function SetType($type) { $this->type = $type; }
    public function SetDescription($description) {$this->description = $description; }
    public function SetConverImage($coverImage) { $this->converImage = $coverImage; }
}
