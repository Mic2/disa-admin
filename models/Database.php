<?php
// This page has an array of db access info, wich is not included in git repository
require_once($_SERVER['DOCUMENT_ROOT'].'/Ressources/dbAccess.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/models/Movie.php');

class Database {
    
    private $con;
    
    function __construct() {
        // Getting the information for the connection
        $dbInfo = getDatabasebAccessInfo();

        $this->con = new mysqli($dbInfo['hostname'], $dbInfo['username'], $dbInfo['password'], $dbInfo['database']);
        $this->con->set_charset("utf8");
        
        if(!$this->con) {
            die("Oops we have a problem connecting to the database, plz contact site admin..");
        }
    }
    
    public function GetAllMovieNames() {
        $moviesToReturn = array();
        $query = "SELECT PK_movieName FROM Movie";
        $result = mysqli_query($this->con, $query);
        
        while($movieNames = mysqli_fetch_object($result)) {
            array_push($moviesToReturn, $movieNames);
        }       
        $result->close();
        
        return $moviesToReturn;
    }    
    
    public function GetMovieDetails($movieName) {
        $movieTime = array();
        $movieTheaterNumber = array();
        $movieShowTimeId = array();
        $movie = new Movie();
              
        $query = "SELECT * FROM ((Movie INNER JOIN MovieType ON Movie.FK_type = MovieType.PK_type) INNER JOIN ShowTime ON Movie.PK_movieName = ShowTime.FK_movieName) WHERE Movie.PK_movieName = '" . $movieName . "'";
        $result = mysqli_query($this->con, $query);
        
        while($movieDetails = mysqli_fetch_object($result)) {
            $movie->SetMovieName($movieDetails->PK_movieName);
            $movie->SetType($movieDetails->FK_type);
            $movie->SetRunTime($movieDetails->runTime);
            $movie->SetDescription($movieDetails->description);
            $movie->SetConverImage($movieDetails->coverImage);
            array_push($movieTime, $movieDetails->FK_time);
            array_push($movieTheaterNumber, $movieDetails->FK_theaterNumber);
            array_push($movieShowTimeId, $movieDetails->PK_showTimeId);
        }
        $result->close();
        
        $movieDetailsToReturn = array(
            'movie' => $movie,
            'showtimeid' => $movieShowTimeId,
            'theater' => $movieTheaterNumber,
            'time' => $movieTime,
        );        
        return $movieDetailsToReturn;
    }
    
    public function InsertMovie($movie) {
        $query = $this->con->prepare("INSERT INTO Movie(PK_movieName, FK_type, runTime, description, coverImage) VALUES(?, ?, ?, ?, ?)");
        $query->bind_param("sssss", $movie->GetMovieName(), $movie->GetType(), $movie->GetRunTime(), $movie->GetDescription(), $movie->GetCoverImage());
        $query->execute();
        $query->close();      
    }    
    
    public function CheckShowTimeExistence($dateTime) {
        
        $query = "SELECT time FROM Time WHERE time = '" . $dateTime . "'";
        $result = mysqli_query($this->con, $query);
        $showTime = mysqli_fetch_object($result);
        $result->close(); 
        
        if(empty($showTime)) {
            $query = $this->con->prepare("INSERT INTO Time (time) VALUES(?)");
            $query->bind_param("s", $dateTime);
            $query->execute();
            $query->close();
        }
    }
    
    public function InsertShowTime($movieName, $dateTime, $theaterNumber) {
        $query = $this->con->prepare("INSERT INTO ShowTime(FK_movieName, FK_theaterNumber, FK_time) VALUES(?, ?, ?)");
        $query->bind_param("sis", $movieName, $theaterNumber, $dateTime);
        $query->execute();
        $query->close();  
    }
    
    public function RemoveShowTimeById($showTimeId) {
        $query = "DELETE FROM ShowTime WHERE PK_showTimeId='".$showTimeId."'";
        mysqli_query($this->con, $query);
    }
     
    public function CloseConnection() {
        $this->con->close();
    }
    
    
}
// TEST
$db = new Database();

$r = $db->RemoveShowTimeById(30);
